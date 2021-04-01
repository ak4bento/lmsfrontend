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

Route::resource('userTeachers', App\Http\Controllers\UserTeacherController::class);

Route::resource('subjects', App\Http\Controllers\SubjectController::class);

Route::resource('teachingPeriods', App\Http\Controllers\TeachingPeriodController::class);

Route::resource('classrooms', App\Http\Controllers\ClassroomController::class);

Route::resource('classroomUsers', App\Http\Controllers\ClassroomUserController::class);

Route::resource('profiles', App\Http\Controllers\ProfileController::class);