<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardAnswerRequest;
use App\Http\Requests\UpdateFlashcardAnswerRequest;
use App\Repositories\FlashcardAnswerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FlashcardAnswerController extends AppBaseController
{
    /** @var  FlashcardAnswerRepository */
    private $flashcardAnswerRepository;

    public function __construct(FlashcardAnswerRepository $flashcardAnswerRepo)
    {
        $this->flashcardAnswerRepository = $flashcardAnswerRepo;
    }

    /**
     * Display a listing of the FlashcardAnswer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardAnswers = $this->flashcardAnswerRepository->all();

        return view('flashcard_answers.index')
            ->with('flashcardAnswers', $flashcardAnswers);
    }

    /**
     * Show the form for creating a new FlashcardAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_answers.create');
    }

    /**
     * Store a newly created FlashcardAnswer in storage.
     *
     * @param CreateFlashcardAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardAnswerRequest $request)
    {
        $input = $request->all();

        $flashcardAnswer = $this->flashcardAnswerRepository->create($input);

        Flash::success('Flashcard Answer saved successfully.');

        return redirect(route('flashcardAnswers.index'));
    }

    /**
     * Display the specified FlashcardAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardAnswer = $this->flashcardAnswerRepository->find($id);

        if (empty($flashcardAnswer)) {
            Flash::error('Flashcard Answer not found');

            return redirect(route('flashcardAnswers.index'));
        }

        return view('flashcard_answers.show')->with('flashcardAnswer', $flashcardAnswer);
    }

    /**
     * Show the form for editing the specified FlashcardAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardAnswer = $this->flashcardAnswerRepository->find($id);

        if (empty($flashcardAnswer)) {
            Flash::error('Flashcard Answer not found');

            return redirect(route('flashcardAnswers.index'));
        }

        return view('flashcard_answers.edit')->with('flashcardAnswer', $flashcardAnswer);
    }

    /**
     * Update the specified FlashcardAnswer in storage.
     *
     * @param int $id
     * @param UpdateFlashcardAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardAnswerRequest $request)
    {
        $flashcardAnswer = $this->flashcardAnswerRepository->find($id);

        if (empty($flashcardAnswer)) {
            Flash::error('Flashcard Answer not found');

            return redirect(route('flashcardAnswers.index'));
        }

        $flashcardAnswer = $this->flashcardAnswerRepository->update($request->all(), $id);

        Flash::success('Flashcard Answer updated successfully.');

        return redirect(route('flashcardAnswers.index'));
    }

    /**
     * Remove the specified FlashcardAnswer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardAnswer = $this->flashcardAnswerRepository->find($id);

        if (empty($flashcardAnswer)) {
            Flash::error('Flashcard Answer not found');

            return redirect(route('flashcardAnswers.index'));
        }

        $this->flashcardAnswerRepository->delete($id);

        Flash::success('Flashcard Answer deleted successfully.');

        return redirect(route('flashcardAnswers.index'));
    }
}
