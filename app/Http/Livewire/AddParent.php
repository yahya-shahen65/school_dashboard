<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use Illuminate\Support\Facades\Storage;
use App\Models\religion;
use App\Models\image;
use Exception;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
class AddParent extends Component
{
    use WithFileUploads;
            //father
    public $email,$pass,$name_father,
        $name_father_en,$job_father,
        $job_father_en,$national_id_father,
        $passport_id_father,$phone_father,
        $nationality_father_id,$blod_type_father_id,
        $religion_father_id,$address_father,
        // mother
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id,
        $iid,$photos;

    public $currentStep=1;
    public $successMessage='';
    public $catchError;
    public $show=true;
    public $update=false;
    public $parent_id;
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'email'=>'string|email',
            'national_id_father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father' => 'min:10 | max:10',
            'phone_father' => 'min:10 | regex:/^([0-9\s\-\+\(\)]*)$/',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'min:10 | regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);
    }
    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities'=>Nationalitie::all(),
            'Type_Bloods'=>Blood::all(),
            'Religions'=>religion::all(),
            'my_parents'=>My_Parent::all()
        ]);
    }

    public function firstStepSubmit(){
        $this->validate([
            'email' => 'required|unique:my__parents,email,'.$this->id,
            'pass' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'national_id_father' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my__parents,national_id_father,' . $this->id,
            'passport_id_father' => 'required|min:10 | max:10|unique:my__parents,passport_id_father,' . $this->id,
            'phone_father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blod_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'address_father' => 'required',
        ]);
        $this->currentStep=2;
    }
    public function secondStepSubmit(){
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my__parents,national_id_mother,' . $this->id,
            'Passport_ID_Mother' => 'required|min:10 | max:10|unique:my__parents,passport_id_mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep=3;
    }
    public function submitForm(){
        try{
            DB::beginTransaction();
            $my_parent=new My_Parent();
            $my_parent->email=$this->email;
            $my_parent->pass=$this->pass;
            $my_parent->name_father=['en'=>$this->name_father_en,'ar'=>$this->name_father];
            $my_parent->job_father=['en'=>$this->job_father_en,'ar'=>$this->job_father,];
            $my_parent->national_id_father=$this->national_id_father;
            $my_parent->passport_id_father=$this->passport_id_father;
            $my_parent->phone_father=$this->phone_father;
            $my_parent->nationality_father_id=$this->nationality_father_id;
            $my_parent->blod_type_father_id=$this->blod_type_father_id;
            $my_parent->religion_father_id=$this->religion_father_id;
            $my_parent->address_father=$this->address_father;
            $my_parent->name_mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $my_parent->national_id_mother = $this->National_ID_Mother;
            $my_parent->passport_id_mother = $this->Passport_ID_Mother;
            $my_parent->phone_mother = $this->Phone_Mother;
            $my_parent->job_mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $my_parent->passport_id_mother = $this->Passport_ID_Mother;
            $my_parent->nationality_mother_id = $this->Nationality_Mother_id;
            $my_parent->blod_type_mother_id = $this->Blood_Type_Mother_id;
            $my_parent->religion_mother_id = $this->Religion_Mother_id;
            $my_parent->address_mother = $this->Address_Mother;
            $my_parent->save();
            // $my_parent=new My_Parent();
            // My_Parent::create([
            //     'email'=>$this->email,
            //     'pass'=>$this->pass,
            //     'name_father'=>[
            //         'ar'=>$this->name_father,
            //         'en'=>$this->name_father_en
            //     ],
            //     'job_father'=>[
            //         'ar'=>$this->job_father,
            //         'en'=>$this->job_father_en
            //     ],
            //     'national_id_father'=>$this->national_id_father,
            //     'passport_id_father'=>$this->passport_id_father,
            //     'phone_father'=>$this->phone_father,
            //     'nationality_father_id'=>$this->nationality_father_id,
            //     'blod_type_father_id'=>$this->blod_type_father_id,
            //     'religion_father_id'=>$this->religion_father_id,
            //     'address_father'=>$this->address_father,

            //     'name_mother'=>[
            //         'ar'=>$this->Name_Mother,
            //         'en'=>$this->Name_Mother_en
            //     ],
            //     'job_mother'=>[
            //         'ar'=>$this->Job_Mother,
            //         'en'=>$this->Job_Mother_en
            //     ],
            //     'national_id_mother'=>$this->National_ID_Mother,
            //     'passport_id_mother'=>$this->Passport_ID_Mother,
            //     'phone_mother'=>$this->Phone_Mother,
            //     'nationality_mother_id'=>$this->Nationality_Mother_id,
            //     'blod_type_mother_id'=>$this->Blood_Type_Mother_id,
            //     'religion_mother_id'=>$this->Religion_Mother_id,
            //     'address_mother'=>$this->Address_Mother,
            // ]);
            // $my_parent->save();

            if(!empty($this->photos)){
                foreach($this->photos as $photo){
                    $name=$photo->getClientOriginalName();
                    $photo->storeAs('attachments/parents/'.$this->national_id_father,$photo->getClientOriginalName(),'upload_attachmemnts');
                    $image= new image();
                    $image->file_name=$name;
                    $image->imageable_id=$my_parent->id;
                    $image->imageable_type='App\Models\My_Parent';
                    $image->save();
                }
            }
            DB::commit();
            $this->successMessage=trans('parents_trans.succsess');
            $this->clear();
            $this->show=true;
            $this->currentStep=1;
        }
        catch(Exception $e){
            DB::rollback();
            $this->catchError = $e->getMessage();
        }
    }
    public function showformadd(){
        $this->show = false;
    }
    public function edit($id){
        $this->show=false;
        $this->update=true;
        $this->parent_id=$id;
        $my_parent=My_Parent::find($id);
        $this->email = $my_parent->email;
        $this->pass = $my_parent->pass;
        $this->name_father = $my_parent->getTranslation('name_father', 'ar');
        $this->name_father_en = $my_parent->getTranslation('name_father', 'en');
        $this->job_father = $my_parent->getTranslation('job_father', 'ar');;
        $this->job_father_en = $my_parent->getTranslation('job_father', 'en');
        $this->national_id_father =$my_parent->national_id_father;
        $this->passport_id_father = $my_parent->passport_id_father;
        $this->phone_father = $my_parent->phone_father;
        $this->nationality_father_id = $my_parent->nationality_father_id;
        $this->blod_type_father_id = $my_parent->blod_type_father_id;
        $this->address_father =$my_parent->address_father;
        $this->religion_father_id =$my_parent->religion_father_id;
        $this->iid=$my_parent->id;
        $this->Name_Mother = $my_parent->getTranslation('name_mother', 'ar');
        $this->Name_Mother_en = $my_parent->getTranslation('name_father', 'en');
        $this->Job_Mother = $my_parent->getTranslation('job_mother', 'ar');;
        $this->Job_Mother_en = $my_parent->getTranslation('job_mother', 'en');
        $this->National_ID_Mother =$my_parent->national_id_mother;
        $this->Passport_ID_Mother = $my_parent->passport_id_mother;
        $this->Phone_Mother = $my_parent->phone_mother;
        $this->Nationality_Mother_id = $my_parent->nationality_mother_id;
        $this->Blood_Type_Mother_id = $my_parent->blod_type_mother_id;
        $this->Address_Mother =$my_parent->address_mother;
        $this->Religion_Mother_id =$my_parent->religion_mother_id;
    }
    public function firstStepSubmit_edit()
    {
        $this->validate([
            'email' => ['required','email',],
            'pass' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'national_id_father' => ['required','string','min:10','max:10','regex:/[0-9]{9}/'],
            'passport_id_father' => ['min:10','max:10'],
            'phone_father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blod_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'address_father' => 'required',
        ]);
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => ['required','string','min:10','max:10','regex:/[0-9]{9}/'],
            'Passport_ID_Mother' => ['min:10','max:10'],
            'Phone_Mother' => 'min:10 | regex:/^([0-9\s\-\+\(\)]*)$/',
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->updateMode = true;
        $this->currentStep = 3;

    }
    public function submitForm_edit(){

        if ($this->parent_id){
            $parent = My_Parent::find($this->parent_id);
            try{
                $parent->update([
                    'email'=>$this->email,
                    'pass'=>$this->pass,
                    'passport_id_father' => $this->passport_id_father,
                    'national_id_father' => $this->national_id_father,
                    'name_father'=>[
                        'ar'=>$this->name_father,
                        'en'=>$this->name_father_en
                    ],
                    'job_father'=>[
                        'ar'=>$this->job_father,
                        'en'=>$this->job_father_en
                    ],
                    'phone_father' => $this->phone_father,
                    'nationality_father_id' => $this->nationality_father_id,
                    'blod_type_father_id' => $this->blod_type_father_id,
                    'religion_father_id' => $this->religion_father_id,
                    'address_father' => $this->address_father,

                    'name_mother'=>[
                        'ar'=>$this->Name_Mother,
                        'en'=>$this->Name_Mother_en
                    ],
                    'job_mother'=>[
                        'ar'=>$this->Job_Mother,
                        'en'=>$this->Job_Mother_en
                    ],
                    'national_id_mother' =>$this->National_ID_Mother,
                    'passport_id_mother' => $this->Passport_ID_Mother,
                    'phone_mother' => $this->Phone_Mother,
                    'nationality_mother_id' => $this->Nationality_Mother_id,
                    'blod_type_mother_id' => $this->Blood_Type_Mother_id,
                    'religion_mother_id' => $this->Religion_Mother_id,
                    'address_mother' => $this->Address_Mother,
                ]);
                $parent->save();
                if(!empty($this->photos)){
                    foreach($this->photos as $photo){
                        $name=$photo->getClientOriginalName();
                        $photo->storeAs('attachments/parents/'.$this->national_id_father,$photo->getClientOriginalName(),'upload_attachmemnts');
                        $image= new image();
                        $image->file_name=$name;
                        $image->imageable_id=$this->parent_id;
                        $image->imageable_type='App\Models\My_Parent';
                        $image->save();
                    }
                }
                return redirect()->to('/add_parent');
            }
            catch(Exception $e){
                $this->catchError=$e->getMessage();
            }

        }
    }
    public function delete($id){
        try{
            $parent=My_Parent::find($id);
            // dd($parent);
            // $my_parent=My_Parent::find($id)->pluck('national_id_father');
            // dd($my_parent);
            foreach($parent->images as $img){
                Storage::disk('upload_attachmemnts')->deleteDirectory('attachments/parents/'.$parent->national_id_father);
                $img->delete();
            }
            My_Parent::find($id)->delete();
            // Storage::deleteDirectory("app/parent_attachment/$my_parent");
            return redirect()->to("add_parent");
        }
        catch(Exception $e){
            $this->catchError=$e->getMessage();
        }
    }
    public function clear(){

        $this->email='';
        $this->pass='';
        $this->name_father='';
        $this->name_father_en='';
        $this->job_father='';
        $this->job_father_en='';
        $this->national_id_father='';
        $this->passport_id_father='';
        $this->phone_father='';
        $this->nationality_father_id='';
        $this->blod_type_father_id='';
        $this->religion_father_id='';
        $this->address_father='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';
    }
    public function back($step){
        $this->currentStep=$step;
    }
}
