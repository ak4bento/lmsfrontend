<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeachableUserRequest;
use App\Http\Requests\UpdateTeachableUserRequest;
use App\Repositories\TeachableUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TeachableUserController extends AppBaseController
{
    /** @var  TeachableUserRepository */
    private $teachableUserRepository;

    public function __construct(TeachableUserRepository $teachableUserRepo)
    {
        $this->teachableUserRepository = $teachableUserRepo;
    }

    /**
     * Display a listing of the TeachableUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $teachableUsers = $this->teachableUserRepository->all();

        return view('teachable_users.index')
            ->with('teachableUsers', $teachableUsers);
    }

    /**
     * Show the form for creating a new TeachableUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('teachable_users.create');
    }

    /**
     * Store a newly created TeachableUser in storage.
     *
     * @param CreateTeachableUserRequest $request
     *
     * @return Response
     */
    public function store(CreateTeachableUserRequest $request)
    {
        $input = $request->all();

        $teachableUser = $this->teachableUserRepository->create($input);

        Flash::success('Teachable User saved successfully.');

        return redirect(route('teachableUsers.index'));
    }

    /**
     * Display the specified TeachableUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teachableUser = $this->teachableUserRepository->find($id);

        if (empty($teachableUser)) {
            Flash::error('Teachable User not found');

            return redirect(route('teachableUsers.index'));
        }

        return view('teachable_users.show')->with('teachableUser', $teachableUser);
    }

    /**
     * Show the form for editing the specified TeachableUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teachableUser = $this->teachableUserRepository->find($id);

        if (empty($teachableUser)) {
            Flash::error('Teachable User not found');

            return redirect(route('teachableUsers.index'));
        }

        return view('teachable_users.edit')->with('teachableUser', $teachableUser);
    }

    /**
     * Update the specified TeachableUser in storage.
     *
     * @param int $id
     * @param UpdateTeachableUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeachableUserRequest $request)
    {
        $teachableUser = $this->teachableUserRepository->find($id);

        if (empty($teachableUser)) {
            Flash::error('Teachable User not found');

            return redirect(route('teachableUsers.index'));
        }

        $teachableUser = $this->teachableUserRepository->update($request->all(), $id);

        Flash::success('Teachable User updated successfully.');

        return redirect(route('teachableUsers.index'));
    }

    /**
     * Remove the specified TeachableUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teachableUser = $this->teachableUserRepository->find($id);

        if (empty($teachableUser)) {
            Flash::error('Teachable User not found');

            return redirect(route('teachableUsers.index'));
        }

        $this->teachableUserRepository->delete($id);

        Flash::success('Teachable User deleted successfully.');

        return redirect(route('teachableUsers.index'));
    }
}
