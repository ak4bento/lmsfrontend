<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionChoiceItemRequest;
use App\Http\Requests\UpdateQuestionChoiceItemRequest;
use App\Repositories\QuestionChoiceItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class QuestionChoiceItemController extends AppBaseController
{
    /** @var  QuestionChoiceItemRepository */
    private $questionChoiceItemRepository;

    public function __construct(QuestionChoiceItemRepository $questionChoiceItemRepo)
    {
        $this->questionChoiceItemRepository = $questionChoiceItemRepo;
    }

    /**
     * Display a listing of the QuestionChoiceItem.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $questionChoiceItems = $this->questionChoiceItemRepository->all();

        return view('question_choice_items.index')
            ->with('questionChoiceItems', $questionChoiceItems);
    }

    /**
     * Show the form for creating a new QuestionChoiceItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_choice_items.create');
    }

    /**
     * Store a newly created QuestionChoiceItem in storage.
     *
     * @param CreateQuestionChoiceItemRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionChoiceItemRequest $request)
    {
        $input = $request->all();

        $questionChoiceItem = $this->questionChoiceItemRepository->create($input);

        Flash::success('Question Choice Item saved successfully.');

        return redirect(route('questionChoiceItems.index'));
    }

    /**
     * Display the specified QuestionChoiceItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionChoiceItem = $this->questionChoiceItemRepository->find($id);

        if (empty($questionChoiceItem)) {
            Flash::error('Question Choice Item not found');

            return redirect(route('questionChoiceItems.index'));
        }

        return view('question_choice_items.show')->with('questionChoiceItem', $questionChoiceItem);
    }

    /**
     * Show the form for editing the specified QuestionChoiceItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionChoiceItem = $this->questionChoiceItemRepository->find($id);

        if (empty($questionChoiceItem)) {
            Flash::error('Question Choice Item not found');

            return redirect(route('questionChoiceItems.index'));
        }

        return view('question_choice_items.edit')->with('questionChoiceItem', $questionChoiceItem);
    }

    /**
     * Update the specified QuestionChoiceItem in storage.
     *
     * @param int $id
     * @param UpdateQuestionChoiceItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionChoiceItemRequest $request)
    {
        $questionChoiceItem = $this->questionChoiceItemRepository->find($id);

        if (empty($questionChoiceItem)) {
            Flash::error('Question Choice Item not found');

            return redirect(route('questionChoiceItems.index'));
        }

        $questionChoiceItem = $this->questionChoiceItemRepository->update($request->all(), $id);

        Flash::success('Question Choice Item updated successfully.');

        return redirect(route('questionChoiceItems.index'));
    }

    /**
     * Remove the specified QuestionChoiceItem from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionChoiceItem = $this->questionChoiceItemRepository->find($id);

        if (empty($questionChoiceItem)) {
            Flash::error('Question Choice Item not found');

            return redirect(route('questionChoiceItems.index'));
        }

        $this->questionChoiceItemRepository->delete($id);

        Flash::success('Question Choice Item deleted successfully.');

        return redirect(route('questionChoiceItems.index'));
    }
}
