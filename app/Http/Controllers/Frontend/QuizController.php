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
use App\Models\Grade;
use App\Models\QuestionChoiceItem;
use Response;
use App\Models\TeachableUser;
use App\Models\ClassroomUser;
use App\Repositories\QuizAttemptRepository;
use App\Models\QuizAttempt;
use App\Models\QuestionQuizzes;
use Alert;
use Illuminate\Support\Facades\Storage;

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
            $remainingTime = date("D M d Y H:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("D M d Y H:i:s")));
            session()->put('remainingTime', date("D M d Y H:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("D M d Y H:i:s"))));
        }else{
            $timeStart = date("D M d Y H:i:s"); 
            $timeEnd = date("D M d Y H:i:s",strtotime('1 hour')); 
            session()->put('timerStartQuiz', $timeStart); 
            session()->put('timerEndQuiz', $timeEnd); 
            $remainingTime = date("D M d Y H:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(session()->get('timerStartQuiz')));
            session()->put('remainingTime', date("D M d Y H:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(date("D M d Y H:i:s"))));
        }

        if(session()->get('timerEndQuiz') ==  date("D M d Y H:i:s")){
            $remainingTime = date("D M d Y H:i:s",strtotime(session()->get('timerEndQuiz')) - strtotime(session()->get('timerStartQuiz')));
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
        if($quiz == null){
            Alert::error('Belum ada Soal.');

            return redirect()->route('class.work.detail', ['slug'=> 'quizzes' ,'id'=>$id]);
        }
 
        $teachable = DB::table('teachables') 
                    ->select('*')
                    ->where('teachable_type','quiz')  
                    ->where('teachable_id',$id)
                    ->first();
        
        $classroom_user =  DB::table('classroom_user') 
                        ->where('classroom_id',$teachable->classroom_id)
                        ->where('user_id',Auth::user()->id)
                        ->select('*')
                        ->first();
        
        $teachableUser =  DB::table('teachable_users')   
                        ->select('*')
                        ->where('teachable_id',$teachable->id)  
                        ->where('classroom_user_id',$classroom_user->id)
                        ->first();
        
                        if(!is_null($teachableUser)){
                            Alert::error('Anda tidak dapat mengakses halaman ini');
                            return back();
                        }

        $quiz_attempts =  DB::table('quiz_attempts')   
                        ->select('*')
                        ->where('teachable_user_id',$teachableUser->id)  
                        ->first();       
        if(!is_null($quiz_attempts)){
            Alert::error('Anda tidak dapat mengakses halaman ini');
            return back();
        }

         try {
            // my data storage location is project_root/storage/app/data.json file.
            $json_file_name = 'quiz_id-'.$id.'-user_id-'.auth()->user()->id.'.json';
            $dataQuiz = Storage::disk('local')->exists($json_file_name) ? json_decode(Storage::disk('local')->get($json_file_name)) : [];
            
            if(count($dataQuiz)==0){
                $data = array(
                     'data' => array(
                         'quiz_id' => $id,
                         'user_id' => auth()->user()->id,
                         'timerStartQuiz' =>  session()->get('timerStartQuiz'),
                         'timerEndQuiz' =>   session()->get('timerEndQuiz'),
                         'datetime_submitted' => date('Y-m-d H:i:s'),
                     ),
                     'answer' => array(),
                );
                array_push($dataQuiz,$data);
            }
            

            // array_replace($dataQuiz,$inputData);
            
            // $dataQuiz->datetime_submitted = date('Y-m-d H:i:s');
            Storage::disk('local')->put($json_file_name, json_encode($dataQuiz));
  
 
        } catch(Exception $e) {
 
            return ['error' => true, 'message' => $e->getMessage()];
 
        }

        return view('frontend.users.quiz')
                ->with('quizzes',$quizzes)
                ->with('question',$question)
                ->with('quiz', $quiz)
                ->with('teachable',$teachable)
                ->with('remainingTime',$remainingTime);
    }

    public function getQuestion($id)
    {
        $question = DB::table('questions')->select('*')->where('id',$id)->where("deleted_at",null)->first();
        $choceItems = DB::table('question_choice_items')->select('*')->where('question_id',$id)->get();
        // dd($question);
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
        $user_id = 2;
        $teachable     = DB::table('teachables') 
                        ->select('*')
                        ->where('teachable_type','quiz')  
                        ->where('teachable_id',$data['quizzes_id'])
                        ->first();
        $classroomUser = DB::table('classroom_user') 
                        ->select('*')
                        ->where('user_id',$user_id)  
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

        $json_file_name = 'quiz_id-'.$data['quizzes_id'].'-user_id-'.$user_id.'.json';

        $dataQuiz = Storage::disk('local')->exists($json_file_name) ? json_decode(Storage::disk('local')->get($json_file_name)) :  [];
        

        $jumlah_benar = 0;
        foreach ($dataQuiz[0]->answer as $key => $value) {
            $QuestionChoiceItem = QuestionChoiceItem::find($value->checkedItem_id);
            if($QuestionChoiceItem->is_correct){
                $jumlah_benar++;
            }
        }
        // return Response::json($dataQuiz[0]->answer); 

        $QuestionQuizzes = QuestionQuizzes::where('quizzes_id',$data['quizzes_id'])->where('deleted_at',null)->count();
        $nilai = ($jumlah_benar / $QuestionQuizzes) * 100;
        // return Response::json($nilai); 
 
        $model['teachable_user_id'] = $teachableUser->id;
        $model['questions'] =   $data['quizzes_id'];
        $model['answers'] = json_encode($dataQuiz);
        $model['completed_at'] = date("Y/m/d h:i:sa");
        $model['grading_method'] = "standard";
        $save = $model->save(); 
        // dd($model);
        $input = new Grade;

        $input['gradeable_id']  = $model['id'];
        $input['comments']      = '-';
        $input['gradeable_type']= 'quiz';
        $input['graded_by']     = null;
        $input['grade'] = $nilai;
        $save = $input->save();

        return Response::json($save); 
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
