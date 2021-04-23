<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;
use App\Models\Discussion;
use Redirect;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // dd($slug);
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->where('classrooms.deleted_at',null)
                    ->first();
        // dd($classrooms);

        $teachables = DB::table('teachables')
                    ->select('teachables.*')
                    ->where('teachables.classroom_id',$classrooms->id)
                    ->where('teachables.deleted_at',null)
                    ->get();
            // dd($teachables);

        $classroomUsers = DB::table('classroom_user')
                        ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                        ->join('users', 'users.id', '=', 'classroom_user.user_id')
                        ->select('classrooms.*','users.id as user_id')
                        ->where('classroom_user.user_id',Auth::user()->id)
                        ->where('classroom_user.classroom_id',$classrooms->id)
                        ->where('classroom_user.deleted_at',null)
                        ->count();
        $subjects = Subject::all();
        // dd($teachables);
        return view('frontend.users.classDetail')
                ->with('classroomUsers', $classroomUsers)
                ->with('classrooms', $classrooms)
                ->with('subjects',$subjects)
                ->with('teachables',$teachables);
    }


    /**
     * discussions the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function discussions(Request $request, $slug, $id)
    {
        // dd($request);
        $discuss = new Discussion;

        $discuss['discussable_type'] = $slug;
        $discuss['discussable_id'] = $id;
        $discuss['message'] = $request['comment'];
        $discuss['user_id'] = Auth::user()->id;
        // dd($classrooms);

        $discuss->save();

        $subjects = Subject::all();

        return Redirect::back();
    }

    public function classWork($slug,$id)
    {
        $classWork = DB::table($slug)->where('id',$id)->first();

        $discussions = DB::table('discussions')->where('discussable_type',$slug)->where('discussable_id',$id)->get();

        // dd($classWork);

        if($slug =='resources'){
            $teachable     = DB::table('teachables')
                            ->select('*')
                            ->where('teachable_type','resource')
                            ->where('teachable_id',$classWork->id)
                            ->first();
            $classroomUser = DB::table('classroom_user')
                            ->select('*')
                            ->where('user_id',Auth::user()->id)
                            ->where('classroom_id',$teachable->classroom_id)
                            ->first();
            $teachableUser = DB::table('teachable_users')
                            ->select('*')
                            ->where('classroom_user_id',$classroomUser->id)
                            ->where('teachable_id',$teachable->id)
                            ->first();
            $classrooms = Classroom::find($teachable->classroom_id);
            return view('frontend.classWork.resources')->with('classWork',$classWork)->with('classrooms',$classrooms)->with('discussions',$discussions);
        }

        if($slug =='assignments'){
            $complete = DB::table('media')
                ->where('media_type','assigment')
                ->where('media_id',$id)
                ->where('custom_properties','{"user":'.Auth::user()->id.'}')
                ->first();
            // dd($complete);
            $teachable     = DB::table('teachables')
                            ->select('*')
                            ->where('teachable_type','assignment')
                            ->where('teachable_id',$classWork->id)
                            ->first();
            $classrooms = Classroom::find($teachable->classroom_id);

            return view('frontend.classWork.assignments')->with('classWork',$classWork)->with('complete',$complete)->with('classrooms',$classrooms)->with('discussions',$discussions);
        }


        if($slug == 'quizzes'){
            $teachable     = DB::table('teachables')
                            ->select('*')
                            ->where('teachable_type','quiz')
                            ->where('teachable_id',$classWork->id)
                            ->first();
            $classroomUser = DB::table('classroom_user')
                            ->select('*')
                            ->where('user_id',Auth::user()->id)
                            ->where('classroom_id',$teachable->classroom_id)
                            ->first();
            $teachableUser = DB::table('teachable_users')
                            ->select('*')
                            ->where('classroom_user_id',$classroomUser->id)
                            ->where('teachable_id',$teachable->id)
                            ->first();
            $quiz_attempts = DB::table('quiz_attempts')
                            ->select('*')
                            ->where('teachable_user_id',$teachableUser->id)
                            ->get();

            $classrooms = Classroom::find($teachable->classroom_id);

                            // dd($quiestion_quiz);
            return view('frontend.classWork.quizzes')->with('classWork',$classWork)->with('quiz_attempts',$quiz_attempts->count())->with('teachable',$teachable)->with('classrooms',$classrooms);
        }
        return view('frontend.classWork.'.$slug)->with('classWork',$classWork)->with('discussions',$discussions);
        // return view('frontend.classWork.'.$slug)->with('classWork',$classWork);

        // if($slug == 'quizzes'){
        //     return view('frontend.classWork.quizzes')->with('classWork',$classWork);
        // }
        // if($slug == 'resource'){
        //     return view('frontend.classWork.resource')->with('classWork',$classWork);
        // }
    }
}
