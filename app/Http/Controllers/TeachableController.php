<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeachableRequest;
use App\Http\Requests\UpdateTeachableRequest;
use App\Repositories\TeachableRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TeachableController extends AppBaseController
{
    /** @var  TeachableRepository */
    private $teachableRepository;

    public function __construct(TeachableRepository $teachableRepo)
    {
        $this->teachableRepository = $teachableRepo;
    }

    /**
     * Display a listing of the Teachable.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $teachables = $this->teachableRepository->all();

        return view('teachables.index')
            ->with('teachables', $teachables);
    }

    /**
     * Show the form for creating a new Teachable.
     *
     * @return Response
     */
    public function create()
    {
        return view('teachables.create');
    }

    /**
     * Store a newly created Teachable in storage.
     *
     * @param CreateTeachableRequest $request
     *
     * @return Response
     */
    public function store(CreateTeachableRequest $request)
    {
        $input = $request->all();

        $teachable = $this->teachableRepository->create($input);

        Flash::success('Teachable saved successfully.');

        return redirect(route('teachables.index'));
    }

    /**
     * Display the specified Teachable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teachable = $this->teachableRepository->find($id);

        if (empty($teachable)) {
            Flash::error('Teachable not found');

            return redirect(route('teachables.index'));
        }

        return view('teachables.show')->with('teachable', $teachable);
    }

    /**
     * Show the form for editing the specified Teachable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teachable = $this->teachableRepository->find($id);

        if (empty($teachable)) {
            Flash::error('Teachable not found');

            return redirect(route('teachables.index'));
        }

        return view('teachables.edit')->with('teachable', $teachable);
    }

    /**
     * Update the specified Teachable in storage.
     *
     * @param int $id
     * @param UpdateTeachableRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeachableRequest $request)
    {
        $teachable = $this->teachableRepository->find($id);

        if (empty($teachable)) {
            Flash::error('Teachable not found');

            return redirect(route('teachables.index'));
        }

        $teachable = $this->teachableRepository->update($request->all(), $id);

        Flash::success('Teachable updated successfully.');

        return redirect(route('teachables.index'));
    }

    /**
     * Remove the specified Teachable from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teachable = $this->teachableRepository->find($id);

        if (empty($teachable)) {
            Flash::error('Teachable not found');

            return redirect(route('teachables.index'));
        }

        $this->teachableRepository->delete($id);

        Flash::success('Teachable deleted successfully.');

        return redirect(route('teachables.index'));
    }
}
