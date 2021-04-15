<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;

class DiscoverController extends Controller
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
        // dd($request);
        $classrooms = $this->query()->queryWhere(1)->get();
        dd($classrooms);
        // $classrooms = DB::table('classrooms')
        //     ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
        //     ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
        //     ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
        //     ->get();
        // dd($classrooms);

        $subjects = Subject::all();

        return view('frontend.users.discover')->with('classrooms', $classrooms)->with('subjects',$subjects);
    }

    public function query()
    {
        return DB::table('classrooms')
        ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
        ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
        ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods');
    }

    public function queryWhere($id)
    {
        return $this->where('subjects.id', $id);
    }
}
