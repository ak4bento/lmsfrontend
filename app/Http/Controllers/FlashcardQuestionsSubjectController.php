<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardQuestionsSubjectRequest;
use App\Http\Requests\UpdateFlashcardQuestionsSubjectRequest;
use App\Repositories\FlashcardQuestionsSubjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FlashcardQuestionsSubjectController extends AppBaseController
{
    /** @var  FlashcardQuestionsSubjectRepository */
    private $flashcardQuestionsSubjectRepository;

    public function __construct(FlashcardQuestionsSubjectRepository $flashcardQuestionsSubjectRepo)
    {
        $this->flashcardQuestionsSubjectRepository = $flashcardQuestionsSubjectRepo;
    }

    /**
     * Display a listing of the FlashcardQuestionsSubject.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardQuestionsSubjects = $this->flashcardQuestionsSubjectRepository->all();

        return view('flashcard_questions_subjects.index')
            ->with('flashcardQuestionsSubjects', $flashcardQuestionsSubjects);
    }

    /**
     * Show the form for creating a new FlashcardQuestionsSubject.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_questions_subjects.create');
    }

    /**
     * Store a newly created FlashcardQuestionsSubject in storage.
     *
     * @param CreateFlashcardQuestionsSubjectRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardQuestionsSubjectRequest $request)
    {
        $input = $request->all();

        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->create($input);

        Flash::success('Flashcard Questions Subject saved successfully.');

        return redirect(route('flashcardQuestionsSubjects.index'));
    }

    /**
     * Display the specified FlashcardQuestionsSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->find($id);

        if (empty($flashcardQuestionsSubject)) {
            Flash::error('Flashcard Questions Subject not found');

            return redirect(route('flashcardQuestionsSubjects.index'));
        }

        return view('flashcard_questions_subjects.show')->with('flashcardQuestionsSubject', $flashcardQuestionsSubject);
    }

    /**
     * Show the form for editing the specified FlashcardQuestionsSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->find($id);

        if (empty($flashcardQuestionsSubject)) {
            Flash::error('Flashcard Questions Subject not found');

            return redirect(route('flashcardQuestionsSubjects.index'));
        }

        return view('flashcard_questions_subjects.edit')->with('flashcardQuestionsSubject', $flashcardQuestionsSubject);
    }

    /**
     * Update the specified FlashcardQuestionsSubject in storage.
     *
     * @param int $id
     * @param UpdateFlashcardQuestionsSubjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardQuestionsSubjectRequest $request)
    {
        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->find($id);

        if (empty($flashcardQuestionsSubject)) {
            Flash::error('Flashcard Questions Subject not found');

            return redirect(route('flashcardQuestionsSubjects.index'));
        }

        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->update($request->all(), $id);

        Flash::success('Flashcard Questions Subject updated successfully.');

        return redirect(route('flashcardQuestionsSubjects.index'));
    }

    /**
     * Remove the specified FlashcardQuestionsSubject from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardQuestionsSubject = $this->flashcardQuestionsSubjectRepository->find($id);

        if (empty($flashcardQuestionsSubject)) {
            Flash::error('Flashcard Questions Subject not found');

            return redirect(route('flashcardQuestionsSubjects.index'));
        }

        $this->flashcardQuestionsSubjectRepository->delete($id);

        Flash::success('Flashcard Questions Subject deleted successfully.');

        return redirect(route('flashcardQuestionsSubjects.index'));
    }
}
