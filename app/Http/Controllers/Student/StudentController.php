<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\section;

class StudentController extends Controller
{
    protected $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student=$student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->student->Get_Student();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->student->Create_Student();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        return $this->student->Store_Student($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->show_student($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->student->Edit_student($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudentRequest $request)
    {
        return $this->student->update_student($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->student->delete_student($request->id);
    }

    public function Get_classrooms($id){
        $calsess=Classroom::where('grade_id',$id)->pluck('name_class','id');
        return $calsess;
    }
    public function Get_Sections($id){
        $section=section::where('class_id',$id)->pluck('name_section','id');
        return $section;
    }
    public function Upload_attachment(Request $request){
        return $this->student->Upload_attachment($request);
    }
    public function Delete_attachment(Request $request){
        return $this->student->Delete_attachment($request);
    }
    public function dwonload_attachment($student_name,$file_name){
        return $this->student->dwonload_attachment($student_name,$file_name);
    }
}

