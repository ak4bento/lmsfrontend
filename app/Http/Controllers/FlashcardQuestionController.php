<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardQuestionRequest;
use App\Http\Requests\UpdateFlashcardQuestionRequest;
use App\Repositories\FlashcardQuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use DB;
use Flash;
use Response;
use Auth;

class FlashcardQuestionController extends AppBaseController
{
    /** @var  FlashcardQuestionRepository */
    private $flashcardQuestionRepository;

    public function __construct(FlashcardQuestionRepository $flashcardQuestionRepo)
    {
        $this->flashcardQuestionRepository = $flashcardQuestionRepo;
    }

    /**
     * Display a listing of the FlashcardQuestion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardQuestions = $this->flashcardQuestionRepository->all();

        return view('flashcard_questions.index')
            ->with('flashcardQuestions', $flashcardQuestions);
    }

    /**
     * Show the form for creating a new FlashcardQuestion.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_questions.create');
    }

    /**
     * Store a newly created FlashcardQuestion in storage.
     *
     * @param CreateFlashcardQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardQuestionRequest $request)
    {
        $input = $request->all();

        $images = $request->file('images');
        $images_name = date('Ymd').'-'.Auth::user()->id.'-'.$images->getClientOriginalName();
        // $name_images = pathinfo($images_name, PATHINFO_FILENAME);

        $images_explanation = $request->file('images_explanation');
        $images_name_explanation = date('Ymd').'-'.Auth::user()->id.'-'.$images_explanation->getClientOriginalName();
        // $name_images_explanation = pathinfo($images_name_explanation, PATHINFO_FILENAME);

        $input['images'] = $images_name;
        $input['images_explanation'] = $images_name_explanation;

        $flashcardQuestion = $this->flashcardQuestionRepository->create($input);

        Flash::success('Flashcard Question saved successfully.');

        $images->move('flashcardfiles/images/',$images_name);
        $images_explanation->move('flashcardfiles/images_explanation/',$images_name_explanation);

        return redirect(route('flashcardQuestions.index'));
    }

    /**
     * Display the specified FlashcardQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardQuestion = $this->flashcardQuestionRepository->find($id);

        $flashcardCategoriesQuestions = DB::table('flashcard_categories_questions')->where('flashcard_questions_id',$id)->get();

        if (empty($flashcardQuestion)) {
            Flash::error('Flashcard Question not found');

            return redirect(route('flashcardQuestions.index'));
        }

        return view('flashcard_questions.show')->with('flashcardQuestion', $flashcardQuestion)->with('flashcardCategoriesQuestions', $flashcardCategoriesQuestions);
    }

    /**
     * Show the form for editing the specified FlashcardQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardQuestion = $this->flashcardQuestionRepository->find($id);

        if (empty($flashcardQuestion)) {
            Flash::error('Flashcard Question not found');

            return redirect(route('flashcardQuestions.index'));
        }

        return view('flashcard_questions.edit')->with('flashcardQuestion', $flashcardQuestion);
    }

    /**
     * Update the specified FlashcardQuestion in storage.
     *
     * @param int $id
     * @param UpdateFlashcardQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardQuestionRequest $request)
    {
        $flashcardQuestion = $this->flashcardQuestionRepository->find($id);

        $input = $request->all();

        $images = $request->file('images');
        $images_name = date('Ymd').'-'.Auth::user()->id.'-'.$images->getClientOriginalName();
        // $name_images = pathinfo($images_name, PATHINFO_FILENAME);

        $images_explanation = $request->file('images_explanation');
        $images_name_explanation = date('Ymd').'-'.Auth::user()->id.'-'.$images_explanation->getClientOriginalName();
        // $name_images_explanation = pathinfo($images_name_explanation, PATHINFO_FILENAME);

        $input['images'] = $images_name;
        $input['images_explanation'] = $images_name_explanation;

        if (empty($flashcardQuestion)) {
            Flash::error('Flashcard Question not found');

            return redirect(route('flashcardQuestions.index'));
        }

        $flashcardQuestion = $this->flashcardQuestionRepository->update($input, $id);

        Flash::success('Flashcard Question updated successfully.');

        return redirect(route('flashcardQuestions.index'));
    }

    /**
     * Remove the specified FlashcardQuestion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardQuestion = $this->flashcardQuestionRepository->find($id);

        if (empty($flashcardQuestion)) {
            Flash::error('Flashcard Question not found');

            return redirect(route('flashcardQuestions.index'));
        }

        $this->flashcardQuestionRepository->delete($id);

        Flash::success('Flashcard Question deleted successfully.');

        return redirect(route('flashcardQuestions.index'));
    }
}
