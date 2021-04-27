<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;

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
        $profile = $this->profileRepository->find(Auth::user()->id);

        return view('frontend.users.home')->with('profile', $profile);
    }
}
