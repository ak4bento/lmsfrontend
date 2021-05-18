<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;

class ClassesController extends Controller
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
    public function index(Request $request)
    {
        // DB::enableQueryLog();
        $classrooms = $this->query();
        $classrooms = $classrooms->where(function ($val) use ($request)
        {
            # code...
            foreach ($request->all() as $key => $value) {
                if ($key != 'search') {
                    $val->orWhere('subjects.id', $key);
                }
            }
        });

        $classrooms = $classrooms->where('classrooms.title','like','%'.$request['search'].'%')->orderBy('classrooms.created_at','DESC')->get();
        // dd($classrooms);
        // dd(DB::getQueryLog());
        $subjects = Subject::all();

        return view('frontend.users.classes')->with('classrooms', $classrooms)->with('subjects',$subjects);
    }

    public function query()
    {
        return DB::table('classrooms')
            ->join('classroom_user', 'classroom_user.classroom_id', '=', 'classrooms.id')
            ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
            ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
            ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
            ->where('classroom_user.user_id', Auth::user()->id)
            ->where('classroom_user.deleted_at', null)
            ->where('classrooms.deleted_at', null);
    }
}
