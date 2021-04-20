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

        return view('frontend.classWork.'.$slug)->with('classWork',$classWork)->with('discussions',$discussions);

        // if($slug == 'quizzes'){
        //     return view('frontend.classWork.quizzes')->with('classWork',$classWork);
        // }
        // if($slug == 'resource'){
        //     return view('frontend.classWork.resource')->with('classWork',$classWork);
        // }
    }
}
