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

    /** @var  queryCustom */
    private $queryCustom;

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
        //dd($request->all());
        $classrooms = $this->query();
        foreach ($request->all() as $key => $value) {
            if ($key != 'search') {
                $classrooms = $classrooms->orWhere('subjects.id', $key);
            }
            if ($key == 'search') {
                $classrooms = $classrooms->where('subjects.title','like','%'.$value.'%');
            }
        }
        $subjects = Subject::all();
        $classrooms = $classrooms->orderBy('classrooms.created_at','DESC')->paginate(10);
        if($request->ajax()){
            $view = view('frontend.users.card_classroom_discover',compact('subjects','classrooms'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('frontend.users.discover')->with('classrooms', $classrooms)->with('subjects',$subjects);
    }

    public function query()
    {
        return DB::table('classrooms')
        ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
        ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
        ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
        ->where('classrooms.deleted_at',null);
    }
}
