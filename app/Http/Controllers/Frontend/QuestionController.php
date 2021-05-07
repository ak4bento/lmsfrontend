<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Repositories\QuestionChoiceItemRepository;
use App\Repositories\QuestionQuizzesRepository;
use App\Models\QuestionChoiceItem;
use App\Models\Quizzes;
use DB;
use \stdClass;
use Alert;

class QuestionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo, QuestionChoiceItemRepository $questionChoiceItemRepo,QuestionQuizzesRepository $questionQuizzesRepo)
    {
        $this->questionQuizzesRepository = $questionQuizzesRepo;
        $this->questionChoiceItemRepository = $questionChoiceItemRepo;
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($slug,$id,Request $request)
    {
        $questions = DB::table('question_quizzes')
                    ->join('questions', 'questions.id', '=', 'question_quizzes.question_id')
                    ->join('quizzes', 'quizzes.id', '=', 'question_quizzes.quizzes_id')
                    ->select('questions.*','quizzes.id as quiz_id','quizzes.title','quizzes.description')
                    ->where('quizzes.id',$id)
                    ->where('questions.deleted_at',null)
                    ->get(); 

        $quizzes = Quizzes::find($id); 

        $classroom = DB::table('classrooms')
                    ->select('*')
                    ->where('slug',$slug)
                    ->first();
        // dd($quizzes);
        return view('frontend.teacher.question.index')
                ->with('classroom', $classroom)
                ->with('quizzes', $quizzes)
                ->with('questions', $questions);
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create($slug,$id)
    {  
        $quizzes = Quizzes::find($id); 
        return view('frontend.teacher.question.create')->with('quizzes', $quizzes)->with('slug',$slug);
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store($slug, $id, CreateQuestionRequest $request)
    {
        $input = $request->all();
        $input['scoring_method'] = "default";
        $input['created_by'] = auth()->user()->id;

        $question = $this->questionRepository->create($input);
        $data;

        for($a = 1; $a <= count($input['choice_text']); $a++){
            if(isset($input['choice_text'][$a])){
                $data['question_id'] = $question->id;
                $data['choice_text'] = $input['choice_text'][$a];
                if(isset($input['is_correct'][$a]) ){
                    $data['is_correct'] = 1;
                }else{
                    $data['is_correct'] = 0;
                }
                $data['question_id'] = $question->id;
                $questionChoiceItem = $this->questionChoiceItemRepository->create($data);
            }
        }

        $questionQuizzes['quizzes_id'] = $id;
        $questionQuizzes['question_id'] = $question->id;
        $questionQuizzes = $this->questionQuizzesRepository->create($questionQuizzes);

        Alert::success('Question saved successfully.');
         
        return redirect(route('showAllQuestion',['slug'=>$slug,'id'=>$id]));
    }

    /**
     * Display the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slugClass,$slugQuiz,$id)
    {
        $quizzes = Quizzes::find($slugQuiz); 
// dd($quizzes);
        $question = $this->questionRepository->find($id);
        $question_choice_items = DB::table('question_choice_items')->where('question_id',$id)->where('deleted_at',null)->select('*')->get();
        // dd($item);
        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        return view('frontend.teacher.question.edit')->with('quizzes', $quizzes)->with('slug',$slugClass)->with('question',$question);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param int $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($slug, $id, Request $request)
    {
        $question = $this->questionRepository->find($id);
        $input =$request->all(); 
        // dd($input);
        date_default_timezone_set("Asia/Makassar"); 
        $QuestionChoiceItem = QuestionChoiceItem::where('question_id', $id)->select('*')->get();
        $delete['deleted_at'] =  date("Y-m-d h:i:s");
        foreach($QuestionChoiceItem as $data){  
            DB::table('question_choice_items')->where('id', $data->id)->update($delete);
        }  
        $data=array(0);
        
        for($a = 0; $a <= count($input['choice_text']); $a++){
            // dd($input['choice_text'][$a] );
            if(isset($input['choice_text'][$a])){
                $question_id = $id; 
                $choice_text = $input['choice_text'][$a];
                if(isset($input['is_correct'][$a]) ){
                    $is_correct = 1;
                }else{
                    $is_correct = 0;
                }
                $question_id = $question->id; 
                $data = DB::table('question_choice_items')
                ->insert(
                    ['question_id' => $question_id,
                    'is_correct' => $is_correct,
                    'choice_text' => $choice_text]
                );
                // $questionChoiceItem = QuestionChoiceItem::create($data);
                // dd($questionChoiceItem);
            }
        }
        if (empty($question)) {
            Flash::error('Question not found');
            
            return redirect(route('questions.index'));
        }
        $input['id'] = $id;
        // dd($input);
        $question = $this->questionRepository->update($input, $id);
        // $question = DB::table('questions')->where('id', $id)->update($request->all());

        Alert::success('Question updated successfully.');

        return redirect(route('showAllQuestion',['slug'=>$slug,'id'=>$input['quizzes_id']]));

    }

    /**
     * Remove the specified Question from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($slug, $quiz_id, $id)
    {
        // dd($id);
        $question = $this->questionRepository->find($id); 
        $questions = DB::table('question_quizzes')
                        ->where('quizzes_id',$quiz_id)
                        ->where('question_id',$id)
                        ->update(['deleted_at' => date("Y/m/d h:i:s")]);
        if (empty($question)) {
            Flash::error('Question not found');
            return redirect(route('showAllQuestion',['slug'=>$slug,'id'=>$quiz_id]));

        }

        $this->questionRepository->delete($id); 
        Alert::success('Berhasil', 'Data Berhasil dihapus');
 
        return redirect(route('showAllQuestion',['slug'=>$slug,'id'=>$quiz_id]));

    }
}
