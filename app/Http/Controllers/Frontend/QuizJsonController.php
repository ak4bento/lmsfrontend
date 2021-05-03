<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;
use App\Repositories\QuizzesRepository;
use App\Repositories\TeachableRepository;
use App\Models\Question;
use App\Models\QuestionChoiceItem;
use Response;
use App\Models\TeachableUser;
use App\Models\ClassroomUser;
use App\Repositories\QuizAttemptRepository;
use App\Models\QuizAttempt;
use Alert;
use Illuminate\Support\Facades\Storage;

class QuizJsonController extends Controller
{
        /** @var  QuizzesRepository */
    private $quizzesRepository;

    public function __construct(QuizzesRepository $quizzesRepo,TeachableRepository $teachableRepo,ClassroomRepository $classroomRepo,QuizAttemptRepository $quizAttemptRepo)
    {
        $this->quizAttemptRepository = $quizAttemptRepo;
        $this->classroomRepository = $classroomRepo;
        $this->teachableRepository = $teachableRepo;
        $this->quizzesRepository = $quizzesRepo;
        $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTimeQuiz($id)
    {
        $json_file_name = 'quiz_id-'.$id.'-user_id-'.auth()->user()->id.'.json';
         
        $jsonString = Storage::disk('local')->get($json_file_name);

        $data = json_decode($jsonString, true);
        return Response::json($data);
    }
 
}
