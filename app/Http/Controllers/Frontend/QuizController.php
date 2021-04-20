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

class QuizController extends Controller
{
        /** @var  QuizzesRepository */
    private $quizzesRepository;

    public function __construct(QuizzesRepository $quizzesRepo,TeachableRepository $teachableRepo,ClassroomRepository $classroomRepo,QuizAttemptRepository $quizAttemptRepo)
    {
        $this->quizAttemptRepository = $quizAttemptRepo;
        $this->classroomRepository = $classroomRepo;
        $this->teachableRepository = $teachableRepo;
        $this->quizzesRepository = $quizzesRepo;
        // $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz($id)
    {
        date_default_timezone_set("Asia/Makassar");
        $remainingTime=0;
        if(session()->get('timerStartQuiz')){
            $remainingTime = date("h:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("h:i:s")));
            session()->put('remainingTime', date("h:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("h:i:s"))));
        }else{
            $timeStart =  date("H:i:s"); 
            $timeEnd = date('H:i:s', strtotime($timeStart) + 60*60);
            session()->put('timerStartQuiz', $timeStart); 
            session()->put('timerEndQuiz', $timeEnd); 
            $remainingTime = date("h:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(session()->get('timerStartQuiz')));
            session()->put('remainingTime', date("h:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("h:i:s"))));
        }

        if(session()->get('timerEndQuiz') ==  date("h:i:s")){
            $remainingTime = date("h:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(session()->get('timerStartQuiz')));
        }

        $quizzes = $this->quizzesRepository->find($id);
        $question = DB::table('question_quizzes')  
            ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')  
            ->select('questions.*')
            ->inRandomOrder()
            ->where('question_quizzes.quizzes_id',$id)
            ->get();
        $quiz =  DB::table('question_quizzes')  
                ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')  
                ->select('questions.*')
                ->inRandomOrder()
                ->where('question_quizzes.quizzes_id',$id) 
                ->where('question_quizzes.deleted_at',null) 
                ->where('questions.deleted_at',null) 
                ->first(); 
        // dd($quizzes);
        return view('frontend.users.quiz')->with('quizzes',$quizzes)->with('question',$question)->with('quiz', $quiz)->with('remainingTime',$remainingTime);
    }

    public function getQuestion($id)
    {
        $question = DB::table('questions')->select('*')->where('id',$id)->where("deleted_at",null)->first();
        $choceItems = DB::table('question_choice_items')->select('*')->where('question_id',$id)->get();

        $question_choceItems = DB::table('question_choice_items')  
                    ->join('questions', 'questions.id', '=', 'question_choice_items.question_id')  
                    ->select('questions.*','question_choice_items.id as qc_id','question_choice_items.choice_text', 'question_choice_items.is_correct')
                    ->inRandomOrder()
                    ->where('question_choice_items.question_id',$id)->where('question_choice_items.deleted_at',null)
                    ->get();

        $data = array('question_choceItems'=>$question_choceItems);
        return Response::json($question_choceItems);
    }

    public function getQuiz($id)
    {
        $quiz =  DB::table('question_quizzes')  
                ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')  
                ->select('questions.*')
                ->inRandomOrder()
                ->where('question_quizzes.quizzes_id',$id) 
                ->where('question_quizzes.deleted_at',null) 
                ->where('questions.deleted_at',null) 
                ->get(); 
        return Response::json($quiz);
    }

    public function submitQuiz(Request $request)
    {
        $data = $request->all(); 
        $value = json_decode($data['allData']); 
        $teachable     = DB::table('teachables') 
                        ->select('*')
                        ->where('teachable_type','quiz')  
                        ->where('teachable_id',$value->quizzes_id)
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
        
        $model = new QuizAttempt;
        if($quiz_attempts->count()>0){
            $model['attempt'] = $quiz_attempts->count() + 1;
        }

        date_default_timezone_set("Asia/Makassar");

        $model['teachable_user_id'] = $teachableUser->id;
        $model['questions'] = $value->quizzes_id;
        $model['answers'] = json_encode($value->data);
        $model['completed_at'] = date("Y/m/d h:i:sa");
        $model['grading_method'] = "standard";
        $save = $model->save(); 
        

        return Response::json($save);
        
        // switch (json_last_error())
        // {
        // case JSON_ERROR_NONE: $value= ' - No errors'."\n";break;
        // case JSON_ERROR_DEPTH: $value= ' - Maximum stack depth exceeded'."\n";break;
        // case JSON_ERROR_STATE_MISMATCH: $value= ' - Underflow or the modes mismatch'."\n";break;
        // case JSON_ERROR_CTRL_CHAR: $value= ' - Unexpected control character found'."\n";break;
        // case JSON_ERROR_SYNTAX: $value= ' - Syntax error, malformed JSON'."\n";break;
        // case JSON_ERROR_UTF8: $value= ' - Malformed UTF-8 characters, possibly incorrectly encoded'."\n";break;
        // default: $value= ' - Unknown error'."\n";break;
        // }
        // $value = $value;
    }

    public function submitedQuiz($id)
    {
        $teachable     = DB::table('teachables') 
                        ->select('*')
                        ->where('teachable_type','quiz')  
                        ->where('teachable_id',$id)
                        ->first();

        $quiestion_quiz = DB::table('question_quizzes')
                        ->join('quizzes', 'quizzes.id', '=', 'question_quizzes.quizzes_id')
                        ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')
                        ->where('quizzes_id',$teachable->teachable_id)
                        ->where('questions.deleted_at',null)
                        ->select('questions.*')
                        ->get();
                        
        $classroom = DB::table('classrooms') 
                        ->where('id',$teachable->classroom_id)
                        ->where('deleted_at',null)
                        ->select('*')
                        ->first();
        return view('frontend.users.quizSubmit')->with('quiestion_quiz',$quiestion_quiz)->with('classroom',$classroom);
    }
}
