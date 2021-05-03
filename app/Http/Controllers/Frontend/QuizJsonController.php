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
        // $this->middleware('auth'); 
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

    public function getChoiceItem(Request $request)
    {
        $data = $request->only(['checked_item','quiz_id']);
        $data = json_decode($data['checked_item']);
        $json_file_name = 'quiz_id-'.$request->quiz_id.'-user_id-'.auth()->user()->id.'.json';
         
        $dataQuiz = Storage::disk('local')->exists($json_file_name) ? json_decode(Storage::disk('local')->get($json_file_name)) :  [];
        try {
        
            $value = array(
                        'answer' => array(
                            'question_id' => $data->question_id,
                            'checkedItem_id' => $data->checkedItem_id,
                        )
                    );
            for ($i=0; $i <= count($dataQuiz); $i++) { 
             
                if(isset($dataQuiz[$i]->answer->question_id)){
                    if($dataQuiz[$i]->answer->question_id == $data->question_id) 
                        $dataQuiz[$i]->answer->question_id = $data->checkedItem_id;
                }
                else{

                    array_push($dataQuiz,$value);
                }

            } 

            Storage::disk('local')->put($json_file_name, json_encode($dataQuiz));
        } catch(Exception $e) {
            
            return ['error' => true, 'message' => $e->getMessage()];
        
        }
        
        return Response::json($data);
    }
}
