<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModelHasRoleRequest;
use App\Http\Requests\UpdateModelHasRoleRequest;
use App\Repositories\ModelHasRoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\ModelHasRole;

class ModelHasRoleController extends AppBaseController
{
    /** @var  ModelHasRoleRepository */
    private $modelHasRoleRepository;

    public function __construct(ModelHasRoleRepository $modelHasRoleRepo)
    {
        $this->modelHasRoleRepository = $modelHasRoleRepo;
    }

    /**
     * Display a listing of the ModelHasRole.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $modelHasRoles = $this->modelHasRoleRepository->all();

        return view('model_has_roles.index')
            ->with('modelHasRoles', $modelHasRoles);
    }

    /**
     * Show the form for creating a new ModelHasRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('model_has_roles.create');
    }

    /**
     * Store a newly created ModelHasRole in storage.
     *
     * @param CreateModelHasRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateModelHasRoleRequest $request)
    {
        $input = $request->all();
        $input['model_type'] = 'App\Models\User';
        // dd($input);
        ModelHasRole::create([
            'role_id'=>$input['role_id'],
            'model_id'=>$input['model_id'],
            'model_type'=>$input['model_type'],
            'timestamps'=>false
            ]);

        Flash::success('Model Has Role saved successfully.');

        return redirect(route('modelHasRoles.index'));
    }

    /**
     * Display the specified ModelHasRole.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modelHasRole = $this->modelHasRoleRepository->find($id);

        if (empty($modelHasRole)) {
            Flash::error('Model Has Role not found');

            return redirect(route('modelHasRoles.index'));
        }

        return view('model_has_roles.show')->with('modelHasRole', $modelHasRole);
    }

    /**
     * Show the form for editing the specified ModelHasRole.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modelHasRole = $this->modelHasRoleRepository->find($id);

        if (empty($modelHasRole)) {
            Flash::error('Model Has Role not found');

            return redirect(route('modelHasRoles.index'));
        }

        return view('model_has_roles.edit')->with('modelHasRole', $modelHasRole);
    }

    /**
     * Update the specified ModelHasRole in storage.
     *
     * @param int $id
     * @param UpdateModelHasRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModelHasRoleRequest $request)
    {
        $modelHasRole = $this->modelHasRoleRepository->find($id);

        if (empty($modelHasRole)) {
            Flash::error('Model Has Role not found');

            return redirect(route('modelHasRoles.index'));
        }

        $modelHasRole = $this->modelHasRoleRepository->update($request->all(), $id);

        Flash::success('Model Has Role updated successfully.');

        return redirect(route('modelHasRoles.index'));
    }

    /**
     * Remove the specified ModelHasRole from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modelHasRole = $this->modelHasRoleRepository->find($id);

        if (empty($modelHasRole)) {
            Flash::error('Model Has Role not found');

            return redirect(route('modelHasRoles.index'));
        }

        $this->modelHasRoleRepository->delete($id);

        Flash::success('Model Has Role deleted successfully.');

        return redirect(route('modelHasRoles.index'));
    }
}
