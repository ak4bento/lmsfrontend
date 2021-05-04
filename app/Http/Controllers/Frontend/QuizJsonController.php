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
        // ini_set('memory_limit', '-1');
        $data = $request->all();
        // $data = json_decode($data['checked_item']);
        $json_file_name = 'quiz_id-'.$request->quiz_id.'-user_id-2.json';
         
        $dataQuiz = Storage::disk('local')->exists($json_file_name) ? json_decode(Storage::disk('local')->get($json_file_name)) :  [];
        
        $data = array(
                'question_id' => $data['question_id'],
                'checkedItem_id' =>  $data['checkedItem_id']
        ); 

        if(count($dataQuiz[0]->answer) == 0){

            array_push($dataQuiz[0]->answer,$data);
            Storage::disk('local')->put($json_file_name, json_encode($dataQuiz));
            
        }else{
            for ($i=0; $i < count($dataQuiz[0]->answer) ; $i++) { 
                if(!isset($dataQuiz[0]->answer[$i]->question_id)){
                    array_push($dataQuiz[0]->answer,$data);
                }
                else if($dataQuiz[0]->answer[$i]->question_id == $data['question_id']){
                    
                    $dataQuiz[0]->answer[$i]->checkedItem_id = $data['checkedItem_id'];
    
                }
                // else{
                //     array_push($dataQuiz[0]->answer,$data);
                // }

                Storage::disk('local')->put($json_file_name, json_encode($dataQuiz));
            }
        }

        return Response::json($dataQuiz[0]->answer);
    }
}
