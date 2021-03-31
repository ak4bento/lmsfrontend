<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeachingPeriodRequest;
use App\Http\Requests\UpdateTeachingPeriodRequest;
use App\Repositories\TeachingPeriodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TeachingPeriodController extends AppBaseController
{
    /** @var  TeachingPeriodRepository */
    private $teachingPeriodRepository;

    public function __construct(TeachingPeriodRepository $teachingPeriodRepo)
    {
        $this->teachingPeriodRepository = $teachingPeriodRepo;
    }

    /**
     * Display a listing of the TeachingPeriod.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $teachingPeriods = $this->teachingPeriodRepository->all();

        return view('teaching_periods.index')
            ->with('teachingPeriods', $teachingPeriods);
    }

    /**
     * Show the form for creating a new TeachingPeriod.
     *
     * @return Response
     */
    public function create()
    {
        return view('teaching_periods.create');
    }

    /**
     * Store a newly created TeachingPeriod in storage.
     *
     * @param CreateTeachingPeriodRequest $request
     *
     * @return Response
     */
    public function store(CreateTeachingPeriodRequest $request)
    {
        $input = $request->all();

        $teachingPeriod = $this->teachingPeriodRepository->create($input);

        Flash::success('Teaching Period saved successfully.');

        return redirect(route('teachingPeriods.index'));
    }

    /**
     * Display the specified TeachingPeriod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teachingPeriod = $this->teachingPeriodRepository->find($id);

        if (empty($teachingPeriod)) {
            Flash::error('Teaching Period not found');

            return redirect(route('teachingPeriods.index'));
        }

        return view('teaching_periods.show')->with('teachingPeriod', $teachingPeriod);
    }

    /**
     * Show the form for editing the specified TeachingPeriod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teachingPeriod = $this->teachingPeriodRepository->find($id);

        if (empty($teachingPeriod)) {
            Flash::error('Teaching Period not found');

            return redirect(route('teachingPeriods.index'));
        }

        return view('teaching_periods.edit')->with('teachingPeriod', $teachingPeriod);
    }

    /**
     * Update the specified TeachingPeriod in storage.
     *
     * @param int $id
     * @param UpdateTeachingPeriodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeachingPeriodRequest $request)
    {
        $teachingPeriod = $this->teachingPeriodRepository->find($id);

        if (empty($teachingPeriod)) {
            Flash::error('Teaching Period not found');

            return redirect(route('teachingPeriods.index'));
        }

        $teachingPeriod = $this->teachingPeriodRepository->update($request->all(), $id);

        Flash::success('Teaching Period updated successfully.');

        return redirect(route('teachingPeriods.index'));
    }

    /**
     * Remove the specified TeachingPeriod from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teachingPeriod = $this->teachingPeriodRepository->find($id);

        if (empty($teachingPeriod)) {
            Flash::error('Teaching Period not found');

            return redirect(route('teachingPeriods.index'));
        }

        $this->teachingPeriodRepository->delete($id);

        Flash::success('Teaching Period deleted successfully.');

        return redirect(route('teachingPeriods.index'));
    }
}
