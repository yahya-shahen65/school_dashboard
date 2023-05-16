<?php
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\classrooms\ClassroomController;
use App\Http\Controllers\sections\SectionController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\teachers\TeacherController;
use App\Http\Controllers\Subjects\SubjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/app',function(){
    return view('layouts.app');
});
Route::get('/connect',function(){
    return view('pages.basics.connect');
});
Route::get('/profile',function(){
    return view('home');
});
Route::get('/', function()
{
    return view('auth.login');
})->middleware('guest');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('Classrooms', ClassroomController::class)->middleware('auth');
Route::resource('Grades', GradeController::class)->middleware('auth');
Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all')->middleware('auth');
Route::resource('filter_classes', ClassroomController::class)->middleware('auth');
Route::resource('Sections', SectionController::class)->middleware('auth');
Route::post('filter_classes',[ClassroomController::class,'filter_classes'])->name('filter')->middleware('auth');
Route::get('classes/{id}',[SectionController::class,'getClasess'])->middleware('auth');
Route::view('add_parent','livewire.show_form')->middleware('auth');
Route::resource('Teachers', TeacherController::class)->middleware('auth');
Route::resource('Students',StudentController::class )->middleware('auth');
Route::get('Get_classrooms/{id}',[StudentController::class,'Get_classrooms'])->middleware('auth');
Route::get('Get_Sections/{id}',[StudentController::class,'Get_Sections'])->middleware('auth');
Route::post('Upload_attachment',[StudentController::class,'Upload_attachment'])->name('Upload_attachment');
Route::post('Delete_attachment',[StudentController::class,'Delete_attachment'])->name('Delete_attachment');
Route::get('dwonload_attachment/{student_name}/{file_name}',[StudentController::class,'dwonload_attachment'])->name('dwonload_attachment');

// Route::group(['namespace' => 'Subjects'], function () {
//     Route::resource('Subjects', 'SubjectController');
// });
Route::resource('Subjects',SubjectController::class )->middleware('auth');
