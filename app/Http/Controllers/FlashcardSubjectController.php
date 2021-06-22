<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardSubjectRequest;
use App\Http\Requests\UpdateFlashcardSubjectRequest;
use App\Repositories\FlashcardSubjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;

class FlashcardSubjectController extends AppBaseController
{
    /** @var  FlashcardSubjectRepository */
    private $flashcardSubjectRepository;

    public function __construct(FlashcardSubjectRepository $flashcardSubjectRepo)
    {
        $this->flashcardSubjectRepository = $flashcardSubjectRepo;
    }

    /**
     * Display a listing of the FlashcardSubject.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardSubjects = $this->flashcardSubjectRepository->all();

        return view('flashcard_subjects.index')
            ->with('flashcardSubjects', $flashcardSubjects);
    }

    /**
     * Show the form for creating a new FlashcardSubject.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_subjects.create');
    }

    /**
     * Store a newly created FlashcardSubject in storage.
     *
     * @param CreateFlashcardSubjectRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardSubjectRequest $request)
    {
        $input = $request->all(); 

        $files = $request->file('files');

        $files_name = date('Ymd').'-'.Auth::user()->id.'-'.$files->getClientOriginalName();
        $extension = $request->file('files')->extension();

        $input['files'] = $files_name;
        $input['subject_type'] = $extension;

        $flashcardSubject = $this->flashcardSubjectRepository->create($input);

        Flash::success('Flashcard Subject saved successfully.');
        $files->move('flashcardfiles/files/',$files_name);

        return redirect(route('flashcardSubjects.index'));
    }

    /**
     * Display the specified FlashcardSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardSubject = $this->flashcardSubjectRepository->find($id);

        if (empty($flashcardSubject)) {
            Flash::error('Flashcard Subject not found');

            return redirect(route('flashcardSubjects.index'));
        }

        return view('flashcard_subjects.show')->with('flashcardSubject', $flashcardSubject);
    }

    /**
     * Show the form for editing the specified FlashcardSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardSubject = $this->flashcardSubjectRepository->find($id);

        if (empty($flashcardSubject)) {
            Flash::error('Flashcard Subject not found');

            return redirect(route('flashcardSubjects.index'));
        }

        return view('flashcard_subjects.edit')->with('flashcardSubject', $flashcardSubject);
    }

    /**
     * Update the specified FlashcardSubject in storage.
     *
     * @param int $id
     * @param UpdateFlashcardSubjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardSubjectRequest $request)
    {
        $flashcardSubject = $this->flashcardSubjectRepository->find($id);

        $input = $request->all();

        if ($request->file('files')) {
            $files = $request->file('files');
            $files_name = date('Ymd').'-'.Auth::user()->id.'-'.$files->getClientOriginalName();
            $extension = $request->file('files')->extension();
            $input['files'] = $files_name;
            $input['subject_type'] = $extension;
        }

        if (empty($flashcardSubject)) {
            Flash::error('Flashcard Subject not found');

            return redirect(route('flashcardSubjects.index'));
        }

        $flashcardSubject = $this->flashcardSubjectRepository->update($input, $id);

        Flash::success('Flashcard Subject updated successfully.');
        if ($request->file('files')) {
            $files->move('flashcardfiles/files/',$files_name);
        }

        return redirect(route('flashcardSubjects.index'));
    }

    /**
     * Remove the specified FlashcardSubject from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardSubject = $this->flashcardSubjectRepository->find($id);

        if (empty($flashcardSubject)) {
            Flash::error('Flashcard Subject not found');

            return redirect(route('flashcardSubjects.index'));
        }

        $this->flashcardSubjectRepository->delete($id);

        Flash::success('Flashcard Subject deleted successfully.');

        return redirect(route('flashcardSubjects.index'));
    }
}
