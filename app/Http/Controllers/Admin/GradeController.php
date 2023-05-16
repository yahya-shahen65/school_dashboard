<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGradesRequest;
use App\Models\Classroom;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=Grade::all();
        return view('pages.grades.grades',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradesRequest $request)
    {
        // $request->validate([
        //     'Name'=>'required',
        //     'Name_en'=>'required'
        // ]);
        // if(Grade::where('name->ar',$request->Name)->orwhere('name->en',$request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        // }
        try{
            Grade::create([
                'name'=>[
                    'en'=>$request->Name_en,
                    'ar'=>$request->Name
                ],
                'notes'=>$request->Notes
            ]);
            session()->flash('add',trans('Grades_trans.added'));
            return redirect()->route('Grades.index');
        }
        catch(Exception){

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGradesRequest $request)
    {
        // $request->validate([
        //     'Name'=>'required',
        //     'Name_en'=>'required'
        // ]);
        // if(Grade::where('name->ar',$request->Name)->orwhere('name->en',$request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        // }
        $grade=Grade::find($request->id);
        $grade->update([
            'name'=>[
                'en'=>$request->Name_en,
                'ar'=>$request->Name
            ],
            'notes'=>$request->Notes
        ]);
        $grade->save();
        session()->flash('edit',trans('Grades_trans.updated'));
        return redirect()->route('Grades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $target=Classroom::where('grade_id',$request->id)->pluck('grade_id')->toArray();
        if(count($target)==0){

            $grade=Grade::find($request->id)->delete();
            session()->flash('delete',trans('Grades_trans.deleted'));
            return redirect()->route('Grades.index');
        }
        else{
            return redirect()->back()->withErrors(trans('Grades_trans.delete_grade_error'));
        }
    }
}
