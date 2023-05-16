<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }


    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            session()->flash('add',trans('Sections_trans.added'));
            return redirect()->route('Subjects.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id){

        $subject =Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit',compact('subject','grades','teachers'));

    }

    public function update($request)
    {
        try {
            $subjects =  Subject::findorfail($request->id);
            $subjects->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            session()->flash('edit',trans('Sections_trans.updated'));
            return redirect()->route('Subjects.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Subject::destroy($request->id);
            session()->flash('delete',trans('Sections_trans.deleted'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
