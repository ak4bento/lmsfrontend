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

Route::post('/submit-quiz', [App\Http\Controllers\Frontend\QuizController::class, 'submitQuiz'])->name('submitQuiz');

// teacher assignment
Route::get('create-assignment/{slug}', [App\Http\Controllers\Frontend\AssignmentController::class, 'create'])->name('createAssignment');
Route::post('store-assignment', [App\Http\Controllers\Frontend\AssignmentController::class, 'store'])->name('storeAssignment');
Route::get('edit-assignment/{slug}/{id}', [App\Http\Controllers\Frontend\AssignmentController::class, 'edit'])->name('editAssignment');
Route::post('update-assignment/{id}', [App\Http\Controllers\Frontend\AssignmentController::class, 'update'])->name('updateAssignment');
Route::get('destroy-assignment/{id}', [App\Http\Controllers\Frontend\AssignmentController::class, 'destroy'])->name('destroyAssignment');

Route::group(['middleware' => ['role:student']], function () {
    Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
    Route::get('/discover', [App\Http\Controllers\Frontend\DiscoverController::class, 'index'])->name('discover');
    Route::get('/class-detail/{slug}', [App\Http\Controllers\Frontend\ClassroomController::class, 'show'])->name('classroom.detail');
    Route::get('/class-work-detail/{slug}/{id}', [App\Http\Controllers\Frontend\ClassroomController::class, 'classWork'])->name('class.work.detail');

    Route::post('/upload-assigment', [App\Http\Controllers\Frontend\UploadController::class, 'assigment'])->name('upload.assigment');
    Route::get('/quizzes/quiz/{id}', [App\Http\Controllers\Frontend\QuizController::class, 'quiz'])->name('class.quiz');

    Route::get('/classes', [App\Http\Controllers\Frontend\ClassesController::class, 'index'])->name('classes');

    Route::get('/get-question/{id}', [App\Http\Controllers\Frontend\QuizController::class, 'getQuestion'])->name('getQuestion');
    Route::get('/get-quiz/{id}', [App\Http\Controllers\Frontend\QuizController::class, 'getQuiz'])->name('getQuiz');
    Route::get('/submited-quiz/{id}', [App\Http\Controllers\Frontend\QuizController::class, 'submitedQuiz'])->name('submitedQuiz');
});

Route::group(['middleware' => ['role:super'], 'prefix' => 'admin'], function () {
    //
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    Route::resource('userStudents', App\Http\Controllers\UserStudentController::class);

    Route::get('get-user-students/{id}', [App\Http\Controllers\UserStudentController::class,'getuserStudents']);
    Route::get('userStudents/{id}/destroy', [App\Http\Controllers\UserStudentController::class,'destroy']);


    Route::resource('userTeachers', App\Http\Controllers\UserTeacherController::class);

    Route::resource('subjects', App\Http\Controllers\SubjectController::class);
    Route::get('subjects/destroy/{id}', [App\Http\Controllers\SubjectController::class,'destroy']);

    Route::resource('teachingPeriods', App\Http\Controllers\TeachingPeriodController::class);
    Route::get('teachingPeriods/destroy/{id}', [App\Http\Controllers\TeachingPeriodController::class,'destroy']);

    Route::resource('classrooms', App\Http\Controllers\ClassroomController::class);
    Route::get('classrooms/destroy/{id}', [App\Http\Controllers\ClassroomController::class,'destroy']);
    Route::get('get-classrooms/{id}', [App\Http\Controllers\ClassroomController::class,'getClassroom']);

    Route::resource('classroomUsers', App\Http\Controllers\ClassroomUserController::class);
    Route::get('classroomUsers/destroy/{id}', [App\Http\Controllers\ClassroomUserController::class,'destroy']);
    Route::get('classroomUsers/create/{id}', [App\Http\Controllers\ClassroomUserController::class,'create']);

    Route::resource('profiles', App\Http\Controllers\ProfileController::class);

    Route::resource('quizzes', App\Http\Controllers\QuizzesController::class);
    Route::get('quizzes/destroy/{id}', [App\Http\Controllers\QuizzesController::class,'destroy']);

    Route::resource('questions', App\Http\Controllers\QuestionController::class);
    Route::get('questions/destroy/{id}', [App\Http\Controllers\QuestionController::class,'destroy']);
    Route::post('questions/{id}/store', [App\Http\Controllers\QuestionController::class,'store'])->name('questions.store.id');
    Route::get('questions/create/{id}', [App\Http\Controllers\QuestionController::class,'create'])->name('questions.create.quiz');

    Route::resource('questionQuizzes', App\Http\Controllers\QuestionQuizzesController::class);

    Route::resource('teachables', App\Http\Controllers\TeachableController::class);

    Route::resource('questionChoiceItems', App\Http\Controllers\QuestionChoiceItemController::class);
    Route::get('get-choice-item/{id}', [App\Http\Controllers\QuestionChoiceItemController::class,'getChoiceItem']);
});


Route::resource('resources', App\Http\Controllers\ResourceController::class);

Route::resource('assignments', App\Http\Controllers\AssignmentController::class);


Route::resource('quizAttempts', App\Http\Controllers\QuizAttemptController::class);

Route::resource('teachableUsers', App\Http\Controllers\TeachableUserController::class);