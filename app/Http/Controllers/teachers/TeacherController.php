<?php

namespace App\Http\Controllers\teachers;
use App\Http\Controllers\Controller;
use App\Models\teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
use phpDocumentor\Reflection\Types\This;

class TeacherController extends Controller
{
    protected $teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->teacher=$Teacher;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Teachers= $this->teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders=$this->teacher->getAllGender();
        $specializations=$this->teacher->getAllSpecilization();
        return view('pages.Teachers.create',compact('genders','specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Email'=>'required|email',
            'Password'=>'min:8',
            'Specialization_id'=>'required',
            'Gender_id'=>'required',
            'Joining_Date'=>'required|date|date_format:Y-m-d',
            'Address'=>'required'
        ]);
        return $this->teacher->storeTeacher($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genders=$this->teacher->getAllGender();
        $specializations=$this->teacher->getAllSpecilization();
        $Teachers=teacher::findOrFail($id);
        return view('pages.Teachers.edit',compact('Teachers','genders','specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Email'=>'required|email',
            'Password'=>'min:8',
            'Specialization_id'=>'required',
            'Gender_id'=>'required',
            'Joining_Date'=>'required|date|date_format:Y-m-d',
            'Address'=>'required'
        ]);
        return $this->teacher->updateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->teacher->deleteTeacher($request->id);
    }
}
