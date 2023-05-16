<?php

namespace App\Http\Controllers\classrooms;
use  App\Http\Requests\StoreClassroomsRequest;
use  App\Http\Requests\UpdateClassroomsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\section;
use Exception;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades=Grade::all();
    $Classrooms=Classroom::all();
    return view('pages.classrooms.classrooms',compact('Classrooms','grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassroomsRequest $request)
  {
    // return $request->List_Classes;
    // $request->validate([
    //     'Name'=>'required',
    //     'Name_class_en'=>'required',
    // ]);
    $list_classes=$request->List_Classes;
    // $all=Classroom::all();
    // return count($all);
    // return count($all);
    foreach($list_classes as $list){
            if((Classroom::where('name_class->ar',$list['Name'])->where('grade_id',$list['Grade_id'])->exists())||(Classroom::where('name_class->en',$list['Name_class_en'])->where('grade_id',$list['Grade_id'])->exists())){
                return redirect()->back()->withErrors(trans('Classrooms_trans.exists'));
            }
            else
                {
                        Classroom::create([
                            'name_class'=>[
                                'ar'=>$list['Name'],
                                'en'=>$list['Name_class_en'],
                            ],
                            'grade_id'=>$list['Grade_id']
                        ]);
                }
        }
        session()->flash('add',trans('Classrooms_trans.added'));
        return redirect()->route('Classrooms.index');
}

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    $request->validate([
        'Name'=>'required',
        'Name_en'=>'required',
    ]);
    $all=Classroom::all();
    $Classroom=Classroom::find($request->id);
    foreach ($all as $all) {
        if((Classroom::where('name_class->ar',$request->Name)->where('grade_id',$request->Grade_id)->exists())||(Classroom::where('name_class->en',$request->Name_en)->where('grade_id',$request->Grade_id)->exists())){
            return redirect()->back()->withErrors(trans('Classrooms_trans.exists'));
        }
        else{
            $Classroom->update([
                'name_class'=>[
                    'ar'=>$request->Name,
                    'en'=>$request->Name_en
                ],
                'grade_id'=>$request->Grade_id
            ]);
            session()->flash('edit',trans('Classrooms_trans.updated'));
            return redirect()->route('Classrooms.index');
        }
    }
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $section=section::where('class_id',$request->id)->pluck('class_id')->toArray();
    if(count($section)==0){
        $Classroom=Classroom::find($request->id)->delete();
        session()->flash('delete',trans('Grades_trans.deleted'));
            return redirect()->route('Classrooms.index');
    }
    else{
        return redirect()->back()->withErrors(trans('Classrooms_trans.delete_grade_error'));
    }
}

  public function delete_all(Request $request)
  {
    $delete_all=explode(",",$request->delete_all_id);
        foreach($delete_all as $one_id){
            $section=section::where('class_id',$one_id)->pluck('class_id')->toArray();
            if(count($section)==0){
                continue;
            }
            else{
                return redirect()->back()->withErrors(trans('Classrooms_trans.delete_grades_error'));
            }
        }
    Classroom::wherein('id',$delete_all)->delete();
    session()->flash('delete',trans('Grades_trans.deleted'));
    return redirect()->route('Classrooms.index');
  }

  public function filter_classes(Request $request){
    $grades=Grade::all();
    $grade_id=$request->Grade_id;
    $Classrooms=Classroom::where('grade_id',$grade_id)->get();
    return view('pages.classrooms.classrooms',compact('Classrooms','grades'));
  }

}

?>
