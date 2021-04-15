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

class QuizController extends Controller
{
        /** @var  QuizzesRepository */
    private $quizzesRepository;

    public function __construct(QuizzesRepository $quizzesRepo,TeachableRepository $teachableRepo,ClassroomRepository $classroomRepo)
    {
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
    public function quiz($id)
    {
        $quizzes = $this->quizzesRepository->find($id);
        // $quiz = DB::table('question_quizzes')  
        //     ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')  
        //     ->select('questions.*')
        //     ->inRandomOrder()
        //     ->where('question_quizzes.quizzes_id',$id) 
        //     ->get();
        $quiz = QuestionChoiceItem::all();

        dd($quiz);
        return view('frontend.users.quiz');
    }
}
