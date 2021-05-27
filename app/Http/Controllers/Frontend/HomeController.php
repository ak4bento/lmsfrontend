<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Models\User;
use App\Models\Profile;
use DB;

class HomeController extends Controller
{
    /** @var  ProfileRepository */
    private $profileRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileRepository $profileRepo)
    {
        $this->middleware('auth');
        $this->profileRepository = $profileRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::where('user_id',Auth::user()->id)->first();
        $user = User::find(Auth::user()->id);

        $classroom = DB::table('classrooms')
            ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
            ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
            ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
            ->where('classrooms.deleted_at',null)
            ->orderBy('classrooms.created_at','DESC')
            ->paginate(10);
        // dd($profile);
        return view('frontend.users.home')->with('profile', $profile)->with('user',$user)->with('classroom',$classroom);
    }
}
