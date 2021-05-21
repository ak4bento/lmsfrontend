<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardCategoriesQuestionRequest;
use App\Http\Requests\UpdateFlashcardCategoriesQuestionRequest;
use App\Repositories\FlashcardCategoriesQuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FlashcardCategoriesQuestionController extends AppBaseController
{
    /** @var  FlashcardCategoriesQuestionRepository */
    private $flashcardCategoriesQuestionRepository;

    public function __construct(FlashcardCategoriesQuestionRepository $flashcardCategoriesQuestionRepo)
    {
        $this->flashcardCategoriesQuestionRepository = $flashcardCategoriesQuestionRepo;
    }

    /**
     * Display a listing of the FlashcardCategoriesQuestion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardCategoriesQuestions = $this->flashcardCategoriesQuestionRepository->all();

        return view('flashcard_categories_questions.index')
            ->with('flashcardCategoriesQuestions', $flashcardCategoriesQuestions);
    }

    /**
     * Show the form for creating a new FlashcardCategoriesQuestion.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_categories_questions.create');
    }

    /**
     * Store a newly created FlashcardCategoriesQuestion in storage.
     *
     * @param CreateFlashcardCategoriesQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardCategoriesQuestionRequest $request)
    {
        $input = $request->all();

        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->create($input);

        Flash::success('Flashcard Categories Question saved successfully.');

        return redirect(route('flashcardCategoriesQuestions.index'));
    }

    /**
     * Display the specified FlashcardCategoriesQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->find($id);

        if (empty($flashcardCategoriesQuestion)) {
            Flash::error('Flashcard Categories Question not found');

            return redirect(route('flashcardCategoriesQuestions.index'));
        }

        return view('flashcard_categories_questions.show')->with('flashcardCategoriesQuestion', $flashcardCategoriesQuestion);
    }

    /**
     * Show the form for editing the specified FlashcardCategoriesQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->find($id);

        if (empty($flashcardCategoriesQuestion)) {
            Flash::error('Flashcard Categories Question not found');

            return redirect(route('flashcardCategoriesQuestions.index'));
        }

        return view('flashcard_categories_questions.edit')->with('flashcardCategoriesQuestion', $flashcardCategoriesQuestion);
    }

    /**
     * Update the specified FlashcardCategoriesQuestion in storage.
     *
     * @param int $id
     * @param UpdateFlashcardCategoriesQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardCategoriesQuestionRequest $request)
    {
        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->find($id);

        if (empty($flashcardCategoriesQuestion)) {
            Flash::error('Flashcard Categories Question not found');

            return redirect(route('flashcardCategoriesQuestions.index'));
        }

        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->update($request->all(), $id);

        Flash::success('Flashcard Categories Question updated successfully.');

        return redirect(route('flashcardCategoriesQuestions.index'));
    }

    /**
     * Remove the specified FlashcardCategoriesQuestion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardCategoriesQuestion = $this->flashcardCategoriesQuestionRepository->find($id);

        if (empty($flashcardCategoriesQuestion)) {
            Flash::error('Flashcard Categories Question not found');

            return redirect(route('flashcardCategoriesQuestions.index'));
        }

        $this->flashcardCategoriesQuestionRepository->delete($id);

        Flash::success('Flashcard Categories Question deleted successfully.');

        return redirect(route('flashcardCategoriesQuestions.index'));
    }
}
