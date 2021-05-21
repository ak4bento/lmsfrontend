<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlashcardCategoriesRequest;
use App\Http\Requests\UpdateFlashcardCategoriesRequest;
use App\Repositories\FlashcardCategoriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FlashcardCategoriesController extends AppBaseController
{
    /** @var  FlashcardCategoriesRepository */
    private $flashcardCategoriesRepository;

    public function __construct(FlashcardCategoriesRepository $flashcardCategoriesRepo)
    {
        $this->flashcardCategoriesRepository = $flashcardCategoriesRepo;
    }

    /**
     * Display a listing of the FlashcardCategories.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $flashcardCategories = $this->flashcardCategoriesRepository->all();

        return view('flashcard_categories.index')
            ->with('flashcardCategories', $flashcardCategories);
    }

    /**
     * Show the form for creating a new FlashcardCategories.
     *
     * @return Response
     */
    public function create()
    {
        return view('flashcard_categories.create');
    }

    /**
     * Store a newly created FlashcardCategories in storage.
     *
     * @param CreateFlashcardCategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateFlashcardCategoriesRequest $request)
    {
        $input = $request->all();

        if ($input['parent_id'] == '0') {
            $input['parent_id'] = null;
        }

        $flashcardCategories = $this->flashcardCategoriesRepository->create($input);

        Flash::success('Flashcard Categories saved successfully.');

        return redirect(route('flashcardCategories.index'));
    }

    /**
     * Display the specified FlashcardCategories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flashcardCategories = $this->flashcardCategoriesRepository->find($id);

        if (empty($flashcardCategories)) {
            Flash::error('Flashcard Categories not found');

            return redirect(route('flashcardCategories.index'));
        }

        return view('flashcard_categories.show')->with('flashcardCategories', $flashcardCategories);
    }

    /**
     * Show the form for editing the specified FlashcardCategories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flashcardCategories = $this->flashcardCategoriesRepository->find($id);

        if (empty($flashcardCategories)) {
            Flash::error('Flashcard Categories not found');

            return redirect(route('flashcardCategories.index'));
        }

        return view('flashcard_categories.edit')->with('flashcardCategories', $flashcardCategories);
    }

    /**
     * Update the specified FlashcardCategories in storage.
     *
     * @param int $id
     * @param UpdateFlashcardCategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlashcardCategoriesRequest $request)
    {
        $flashcardCategories = $this->flashcardCategoriesRepository->find($id);

        $input = $request->all();

        if ($input['parent_id'] == '0') {
            $input['parent_id'] = null;
        }

        if (empty($flashcardCategories)) {
            Flash::error('Flashcard Categories not found');

            return redirect(route('flashcardCategories.index'));
        }

        $flashcardCategories = $this->flashcardCategoriesRepository->update($input, $id);

        Flash::success('Flashcard Categories updated successfully.');

        return redirect(route('flashcardCategories.index'));
    }

    /**
     * Remove the specified FlashcardCategories from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flashcardCategories = $this->flashcardCategoriesRepository->find($id);

        if (empty($flashcardCategories)) {
            Flash::error('Flashcard Categories not found');

            return redirect(route('flashcardCategories.index'));
        }

        $this->flashcardCategoriesRepository->delete($id);

        Flash::success('Flashcard Categories deleted successfully.');

        return redirect(route('flashcardCategories.index'));
    }
}
