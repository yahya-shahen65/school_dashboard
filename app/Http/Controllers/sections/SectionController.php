<?php

namespace App\Http\Controllers\sections;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\section;
use App\Models\Grade;
use App\Models\teacher;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=Grade::all();
        $teachers=teacher::all();
        return view('pages.sections.sections',compact('grades','teachers'));
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
    public function store(Request $request)
    {
        try{

            $request->validate([
                'Name'=>'required',
                'Name_en'=>'required',
            ]);
            if((section::where('name_section->ar',$request->Name)->where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->exists())||(section::where('name_section->en',$request->Name_en)->where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->exists())){
                return redirect()->back()->withErrors(trans('Sections_trans.exists'));
            }
            else{
                $section=new section();
                $section->name_section=['ar'=>$request->Name,'en'=>$request->Name_en,];
                $section->grade_id=$request->grade_id;
                $section->class_id=$request->class_id;
                $section->save();
                // section::create([
                //     'name_section'=>[
                //         'ar'=>$request->Name,
                //         'en'=>$request->Name_en,
                //     ],
                //     'grade_id'=>$request->grade_id,
                //     'class_id'=>$request->class_id,
                // ]);
                $section->teachers()->attach($request->teacher_id);
                session()->flash('add',trans('Sections_trans.added'));
                return redirect()->route('Sections.index');
            }
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'Name'=>'required',
            'Name_en'=>'required',
        ]);
        $all=section::all();
        $section=section::find($request->id);
        foreach($all as $all){
            if((section::where('name_section->ar',$request->Name)->where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->exists()) || (section::where('name_section->en',$request->Name_en)->where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->exists())){
                if(isset($request->status)){
                    $section->status=1;
                    $section->save();
                    session()->flash('active',trans('Sections_trans.Active'));
                    return redirect()->back()->withErrors(trans('Classrooms_trans.exists'));
                }
                else{
                    $section->status=0;
                    $section->save();
                    session()->flash('no active',trans('Sections_trans.No'));
                    return redirect()->back()->withErrors(trans('Classrooms_trans.exists'));
                }
            }
            else
            {
                $section->update([
                    'name_section'=>[
                        'ar'=>$request->Name,
                        'en'=>$request->Name_en
                    ],
                    'grade_id'=>$request->grade_id,
                    'class_id'=>$request->class_id,
                ]);
                if(isset($request->status)){
                    $section->status=1;
                }
                else{
                    $section->status=0;
                }
                if(isset($request->teacher_id)){
                    $section->teachers()->sync($request->teacher_id);
                }
                // else{
                //     $section->teachers()->sync(array());
                // }
                $section->save();
                session()->flash('edit',trans('Sections_trans.updated'));
                return redirect()->route('Sections.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section=section::find($request->id)->delete();
        session()->flash('delete',trans('Sections_trans.deleted'));
        return redirect()->route('Sections.index');
    }
    public function getClasess($id){
        $calsess=Classroom::where('grade_id',$id)->pluck('name_class','id');
        return $calsess;
    }
}
