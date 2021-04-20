<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;

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
            ->first();
        // dd($classrooms);

        $teachables = DB::table('teachables')
            ->select('teachables.*')
            ->where('teachables.classroom_id',$classrooms->id)
            ->get();
            // dd($teachables);

        $subjects = Subject::all();

        return view('frontend.users.classDetail')->with('classrooms', $classrooms)->with('subjects',$subjects)->with('teachables',$teachables);
    }

    public function classWork($slug,$id)
    {
        $classWork = DB::table($slug)->where('id',$id)->first();

        $discussions = DB::table('discussions')->where('discussable_type',$slug)->where('discussable_id',$id)->get();

        // dd($discussions);

        if($slug =='assignments'){
            $complete = DB::table('media')
                ->where('media_type','assigment')
                ->where('media_id',$id)
                ->where('custom_properties','{"user":'.Auth::user()->id.'}')
                ->first();
            // dd($complete);
            return view('frontend.classWork.assignments')->with('classWork',$classWork)->with('complete',$complete);
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
        
                            // dd($quiestion_quiz);
            return view('frontend.classWork.quizzes')->with('classWork',$classWork)->with('quiz_attempts',$quiz_attempts->count())->with('teachable',$teachable);
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
