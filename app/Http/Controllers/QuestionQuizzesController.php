<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionQuizzesRequest;
use App\Http\Requests\UpdateQuestionQuizzesRequest;
use App\Repositories\QuestionQuizzesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class QuestionQuizzesController extends AppBaseController
{
    /** @var  QuestionQuizzesRepository */
    private $questionQuizzesRepository;

    public function __construct(QuestionQuizzesRepository $questionQuizzesRepo)
    {
        $this->questionQuizzesRepository = $questionQuizzesRepo;
    }

    /**
     * Display a listing of the QuestionQuizzes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $questionQuizzes = $this->questionQuizzesRepository->all();

        return view('question_quizzes.index')
            ->with('questionQuizzes', $questionQuizzes);
    }

    /**
     * Show the form for creating a new QuestionQuizzes.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_quizzes.create');
    }

    /**
     * Store a newly created QuestionQuizzes in storage.
     *
     * @param CreateQuestionQuizzesRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionQuizzesRequest $request)
    {
        $input = $request->all();

        $questionQuizzes = $this->questionQuizzesRepository->create($input);

        Alert::success('Question Quizzes saved successfully.');

        return redirect(route('questionQuizzes.index'));
    }

    /**
     * Display the specified QuestionQuizzes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionQuizzes = $this->questionQuizzesRepository->find($id);

        if (empty($questionQuizzes)) {
            Flash::error('Question Quizzes not found');

            return redirect(route('questionQuizzes.index'));
        }

        return view('question_quizzes.show')->with('questionQuizzes', $questionQuizzes);
    }

    /**
     * Show the form for editing the specified QuestionQuizzes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionQuizzes = $this->questionQuizzesRepository->find($id);

        if (empty($questionQuizzes)) {
            Flash::error('Question Quizzes not found');

            return redirect(route('questionQuizzes.index'));
        }

        return view('question_quizzes.edit')->with('questionQuizzes', $questionQuizzes);
    }

    /**
     * Update the specified QuestionQuizzes in storage.
     *
     * @param int $id
     * @param UpdateQuestionQuizzesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionQuizzesRequest $request)
    {
        $questionQuizzes = $this->questionQuizzesRepository->find($id);

        if (empty($questionQuizzes)) {
            Flash::error('Question Quizzes not found');

            return redirect(route('questionQuizzes.index'));
        }

        $questionQuizzes = $this->questionQuizzesRepository->update($request->all(), $id);

        Alert::success('Question Quizzes updated successfully.');

        return redirect(route('questionQuizzes.index'));
    }

    /**
     * Remove the specified QuestionQuizzes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionQuizzes = $this->questionQuizzesRepository->find($id);

        if (empty($questionQuizzes)) {
            Flash::error('Question Quizzes not found');

            return redirect(route('questionQuizzes.index'));
        }

        $this->questionQuizzesRepository->delete($id);

        Alert::success('Question Quizzes deleted successfully.');

        return redirect(route('questionQuizzes.index'));
    }
}
