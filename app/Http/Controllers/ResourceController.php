<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Repositories\ResourceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ResourceController extends AppBaseController
{
    /** @var  ResourceRepository */
    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepo)
    {
        $this->resourceRepository = $resourceRepo;
    }

    /**
     * Display a listing of the Resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $resources = $this->resourceRepository->all();

        return view('resources.index')
            ->with('resources', $resources);
    }

    /**
     * Show the form for creating a new Resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created Resource in storage.
     *
     * @param CreateResourceRequest $request
     *
     * @return Response
     */
    public function store(CreateResourceRequest $request)
    {
        $input = $request->all();

        $resource = $this->resourceRepository->create($input);

        Flash::success('Resource saved successfully.');

        return redirect(route('resources.index'));
    }

    /**
     * Display the specified Resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            Flash::error('Resource not found');

            return redirect(route('resources.index'));
        }

        return view('resources.show')->with('resource', $resource);
    }

    /**
     * Show the form for editing the specified Resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            Flash::error('Resource not found');

            return redirect(route('resources.index'));
        }

        return view('resources.edit')->with('resource', $resource);
    }

    /**
     * Update the specified Resource in storage.
     *
     * @param int $id
     * @param UpdateResourceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResourceRequest $request)
    {
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            Flash::error('Resource not found');

            return redirect(route('resources.index'));
        }

        $resource = $this->resourceRepository->update($request->all(), $id);

        Flash::success('Resource updated successfully.');

        return redirect(route('resources.index'));
    }

    /**
     * Remove the specified Resource from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            Flash::error('Resource not found');

            return redirect(route('resources.index'));
        }

        $this->resourceRepository->delete($id);

        Flash::success('Resource deleted successfully.');

        return redirect(route('resources.index'));
    }
}
