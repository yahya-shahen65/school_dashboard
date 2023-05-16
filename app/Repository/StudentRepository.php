<?php
namespace App\Repository;
use App\Models\student;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\My_Parent;
use App\Models\Blood;
use App\Models\image;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{
    public function Get_Student()
    {
        $students = student::all();
        return view('pages.Students.index',compact('students'));
    }
    public function Create_Student(){

        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Blood::all();
        return view('pages.Students.add',$data);

    }
    public function Store_Student($request){

        try {
            DB::beginTransaction();
            $students = new student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->pass =$request->password;
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->grade_id = $request->Grade_id;
            $students->classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            if(!empty($request->photos)){
                foreach($request->file('photos') as $file){
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name,$name,'upload_attachmemnts');
                    $image= new image();
                    $image->file_name=$name;
                    $image->imageable_id=$students->id;
                    $image->imageable_type='App\Models\student';
                    $image->save();
                }
            }
            DB::commit();
            session()->flash('add',trans('Sections_trans.added'));
            return redirect()->route('Students.create');
        }
        catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show_student($id){
        $Student=student::find($id);
        return view('pages.Students.show',compact('Student'));
    }
    public function Edit_student($id){
        $Students=student::find($id);
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Blood::all();
        return view('pages.Students.edit',compact('Students'),$data);

    }
    public function update_student($request){
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->pass = $request->password;
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            session()->flash('edit',trans('Sections_trans.updated'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete_student($id){
        try{
            $student=student::find($id);
            foreach($student->images as $img){
                Storage::disk('upload_attachmemnts')->deleteDirectory('attachments/students/'.$student->name);
                $img->delete();
            }
            student::destroy($id);
            session()->flash('delete',trans('Sections_trans.deleted'));
            return redirect()->route('Students.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    public function Upload_attachment($request){
        if(!empty($request->photos)){
            foreach($request->file('photos') as $file){
                $name=$file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$request->student_name,$name,'upload_attachmemnts');
                $image= new image();
                $image->file_name=$name;
                $image->imageable_id=$request->student_id;
                $image->imageable_type='App\Models\student';
                $image->save();
            }
            session()->flash('add',trans('Sections_trans.added'));
            return redirect()->back();
        }
    }
    public function Delete_attachment($request){
        Storage::disk('upload_attachmemnts')->delete('attachments/students/'.$request->student_name .'/'.$request->filename);
        image::where('id',$request->id)->where('file_name',$request->filename)->delete();
        session()->flash('delete',trans('Sections_trans.deleted'));
        return redirect()->back();
    }
    public function dwonload_attachment($student_name,$file_name){
        return response()->download(public_path('attachments/students/'.$student_name .'/'.$file_name));
    }
}

