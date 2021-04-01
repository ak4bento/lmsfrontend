<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassroomUserRequest;
use App\Http\Requests\UpdateClassroomUserRequest;
use App\Repositories\ClassroomUserRepository;
use App\Repositories\ClassroomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ClassroomUserController extends AppBaseController
{
    /** @var  ClassroomUserRepository */
    private $classroomUserRepository;
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomUserRepository $classroomUserRepo, ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
        $this->classroomUserRepository = $classroomUserRepo;
    }

    /**
     * Display a listing of the ClassroomUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $classroomUsers = $this->classroomUserRepository->all();

        return view('classroom_users.index')
            ->with('classroomUsers', $classroomUsers);
    }

    /**
     * Show the form for creating a new ClassroomUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('classroom_users.create');
    }

    /**
     * Store a newly created ClassroomUser in storage.
     *
     * @param CreateClassroomUserRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomUserRequest $request)
    {
        $input = $request->all();

        $classroomUser = $this->classroomUserRepository->create($input);

        Flash::success('Classroom User saved successfully.');

        return redirect(route('classroomUsers.index'));
    }

    /**
     * Display the specified ClassroomUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classroomUser = $this->classroomUserRepository->find($id);

        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        return view('classroom_users.show')->with('classroomUser', $classroomUser);
    }

    /**
     * Show the form for editing the specified ClassroomUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classroomUser = $this->classroomUserRepository->find($id);
        $classrooms = $this->classroomRepository->all();


        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        return view('classroom_users.edit')->with('classroomUser', $classroomUser)->with('classrooms',$classrooms);
    }

    /**
     * Update the specified ClassroomUser in storage.
     *
     * @param int $id
     * @param UpdateClassroomUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomUserRequest $request)
    {
        $classroomUser = $this->classroomUserRepository->find($id);

        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        $classroomUser = $this->classroomUserRepository->update($request->all(), $id);

        Flash::success('Classroom User updated successfully.');

        return redirect(route('classroomUsers.index'));
    }

    /**
     * Remove the specified ClassroomUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classroomUser = $this->classroomUserRepository->find($id);

        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        $this->classroomUserRepository->delete($id);

        Flash::success('Classroom User deleted successfully.');

        return redirect(route('classroomUsers.index'));
    }
}
