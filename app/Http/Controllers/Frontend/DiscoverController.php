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
        $classrooms = $classrooms->where(function ($val) use ($request)
        {
            # code...
            foreach ($request->all() as $key => $value) {
                if ($key != 'search') {
                    $val->orWhere('subjects.id', $key);
                }
            }
        });

        $subjects = Subject::all();

        $classrooms = $classrooms->where('classrooms.title','like','%'.$request['search'].'%')->orderBy('classrooms.created_at','DESC')->paginate(10);
        // $classrooms = $classrooms->orderBy('classrooms.created_at','DESC')->paginate(10);
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

    public function ajaxRequest(Request $request)
    {
        $classrooms = $this->query();
        $subjects = Subject::all();
        if (isset($request['search'])) {
            $classrooms = $classrooms->where(function ($val) use ($request)
            {
                # code...
                foreach ($request->all() as $key => $value) {
                    if ($key != 'search') {
                        $val->orWhere('subjects.id', $key);
                    }
                }
            });

            $classrooms = $classrooms->where('classrooms.title','like','%'.$request['search'].'%')->orderBy('classrooms.created_at','DESC')->paginate(10);
        } else {
            $classrooms = $classrooms->orderBy('classrooms.created_at','DESC')->paginate(10);
        }
        // dd($classrooms);

        // $classrooms = $classrooms->orderBy('classrooms.created_at','DESC')->paginate(10);
        $view = view('frontend.users.card_classroom_discover',compact('subjects','classrooms'))->render();
        return response()->json(['html'=>$view]);
    }
}
