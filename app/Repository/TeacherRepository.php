<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\specilization;
use App\Models\teacher;
use Exception;

class TeacherRepository implements TeacherRepositoryInterface{
    public function getAllTeachers()
    {
        return teacher::all();
    }
    public function getAllSpecilization(){
        return specilization::all();
    }
    public function getAllGender(){
        return Gender::all();
    }
    public function storeTeacher($request){
        try{
            teacher::create([
                'name'=>[
                    'en'=>$request->Name_en,
                    'ar'=>$request->Name_ar
                ],
                'email'=>$request->Email,
                'pass'=>$request->Password,
                'joining_date'=>$request->Joining_Date,
                'address'=>$request->Address,
                'gender_id'=>$request->Gender_id,
                'specilize_id'=>$request->Specialization_id
            ]);
            session()->flash('add',trans('Sections_trans.added'));
            return redirect()->route('Teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    public function deleteTeacher($id){
        try{
            teacher::find($id)->delete();
            session()->flash('delete',trans('Sections_trans.deleted'));
            return redirect()->route('Teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    public function updateTeacher($request){
        try{
            $teacher=teacher::find($request->id);
            $teacher->update([
                'name'=>[
                    'en'=>$request->Name_en,
                    'ar'=>$request->Name_ar
                ],
                'email'=>$request->Email,
                'pass'=>$request->Password,
                'joining_date'=>$request->Joining_Date,
                'address'=>$request->Address,
                'gender_id'=>$request->Gender_id,
                'specilize_id'=>$request->Specialization_id
            ]);
            session()->flash('edit',trans('Sections_trans.updated'));
            return redirect()->route('Teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
}
