<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizAttemptRequest;
use App\Http\Requests\UpdateQuizAttemptRequest;
use App\Repositories\QuizAttemptRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class QuizAttemptController extends AppBaseController
{
    /** @var  QuizAttemptRepository */
    private $quizAttemptRepository;

    public function __construct(QuizAttemptRepository $quizAttemptRepo)
    {
        $this->quizAttemptRepository = $quizAttemptRepo;
    }

    /**
     * Display a listing of the QuizAttempt.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $quizAttempts = $this->quizAttemptRepository->all();

        return view('quiz_attempts.index')
            ->with('quizAttempts', $quizAttempts);
    }

    /**
     * Show the form for creating a new QuizAttempt.
     *
     * @return Response
     */
    public function create()
    {
        return view('quiz_attempts.create');
    }

    /**
     * Store a newly created QuizAttempt in storage.
     *
     * @param CreateQuizAttemptRequest $request
     *
     * @return Response
     */
    public function store(CreateQuizAttemptRequest $request)
    {
        $input = $request->all();

        $quizAttempt = $this->quizAttemptRepository->create($input);

        Flash::success('Quiz Attempt saved successfully.');

        return redirect(route('quizAttempts.index'));
    }

    /**
     * Display the specified QuizAttempt.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quizAttempt = $this->quizAttemptRepository->find($id);

        if (empty($quizAttempt)) {
            Flash::error('Quiz Attempt not found');

            return redirect(route('quizAttempts.index'));
        }

        return view('quiz_attempts.show')->with('quizAttempt', $quizAttempt);
    }

    /**
     * Show the form for editing the specified QuizAttempt.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quizAttempt = $this->quizAttemptRepository->find($id);

        if (empty($quizAttempt)) {
            Flash::error('Quiz Attempt not found');

            return redirect(route('quizAttempts.index'));
        }

        return view('quiz_attempts.edit')->with('quizAttempt', $quizAttempt);
    }

    /**
     * Update the specified QuizAttempt in storage.
     *
     * @param int $id
     * @param UpdateQuizAttemptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuizAttemptRequest $request)
    {
        $quizAttempt = $this->quizAttemptRepository->find($id);

        if (empty($quizAttempt)) {
            Flash::error('Quiz Attempt not found');

            return redirect(route('quizAttempts.index'));
        }

        $quizAttempt = $this->quizAttemptRepository->update($request->all(), $id);

        Flash::success('Quiz Attempt updated successfully.');

        return redirect(route('quizAttempts.index'));
    }

    /**
     * Remove the specified QuizAttempt from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quizAttempt = $this->quizAttemptRepository->find($id);

        if (empty($quizAttempt)) {
            Flash::error('Quiz Attempt not found');

            return redirect(route('quizAttempts.index'));
        }

        $this->quizAttemptRepository->delete($id);

        Flash::success('Quiz Attempt deleted successfully.');

        return redirect(route('quizAttempts.index'));
    }
}
