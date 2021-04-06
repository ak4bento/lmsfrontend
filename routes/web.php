<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('userStudents', App\Http\Controllers\UserStudentController::class);

Route::get('get-user-students/{id}', [App\Http\Controllers\UserStudentController::class,'getuserStudents']);


Route::resource('userTeachers', App\Http\Controllers\UserTeacherController::class);

Route::resource('subjects', App\Http\Controllers\SubjectController::class);

Route::resource('teachingPeriods', App\Http\Controllers\TeachingPeriodController::class);

Route::resource('classrooms', App\Http\Controllers\ClassroomController::class);

Route::get('get-classrooms/{id}', [App\Http\Controllers\ClassroomController::class,'getClassroom']);


Route::resource('classroomUsers', App\Http\Controllers\ClassroomUserController::class);

Route::get('classroomUsers/create/{id}', [App\Http\Controllers\ClassroomUserController::class,'create']);

Route::resource('profiles', App\Http\Controllers\ProfileController::class);

Route::resource('quizzes', App\Http\Controllers\QuizzesController::class);

Route::resource('questions', App\Http\Controllers\QuestionController::class);

Route::resource('questionQuizzes', App\Http\Controllers\QuestionQuizzesController::class);

Route::resource('teachables', App\Http\Controllers\TeachableController::class);