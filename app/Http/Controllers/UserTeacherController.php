<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserTeacherRequest;
use App\Http\Requests\UpdateUserTeacherRequest;
use App\Repositories\UserTeacherRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserTeacherController extends AppBaseController
{
    /** @var  UserTeacherRepository */
    private $userTeacherRepository;

    public function __construct(UserTeacherRepository $userTeacherRepo)
    {
        $this->userTeacherRepository = $userTeacherRepo;
    }

    /**
     * Display a listing of the UserTeacher.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userTeachers = $this->userTeacherRepository->all();

        return view('user_teachers.index')
            ->with('userTeachers', $userTeachers);
    }

    /**
     * Show the form for creating a new UserTeacher.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_teachers.create');
    }

    /**
     * Store a newly created UserTeacher in storage.
     *
     * @param CreateUserTeacherRequest $request
     *
     * @return Response
     */
    public function store(CreateUserTeacherRequest $request)
    {
        $input = $request->all();

        $userTeacher = $this->userTeacherRepository->create($input);

        Alert::success('User Teacher saved successfully.');

        return redirect(route('userTeachers.index'));
    }

    /**
     * Display the specified UserTeacher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userTeacher = $this->userTeacherRepository->find($id);

        if (empty($userTeacher)) {
            Flash::error('User Teacher not found');

            return redirect(route('userTeachers.index'));
        }

        return view('user_teachers.show')->with('userTeacher', $userTeacher);
    }

    /**
     * Show the form for editing the specified UserTeacher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userTeacher = $this->userTeacherRepository->find($id);

        if (empty($userTeacher)) {
            Flash::error('User Teacher not found');

            return redirect(route('userTeachers.index'));
        }

        return view('user_teachers.edit')->with('userTeacher', $userTeacher);
    }

    /**
     * Update the specified UserTeacher in storage.
     *
     * @param int $id
     * @param UpdateUserTeacherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserTeacherRequest $request)
    {
        $userTeacher = $this->userTeacherRepository->find($id);

        if (empty($userTeacher)) {
            Flash::error('User Teacher not found');

            return redirect(route('userTeachers.index'));
        }

        $userTeacher = $this->userTeacherRepository->update($request->all(), $id);

        Alert::success('User Teacher updated successfully.');

        return redirect(route('userTeachers.index'));
    }

    /**
     * Remove the specified UserTeacher from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userTeacher = $this->userTeacherRepository->find($id);

        if (empty($userTeacher)) {
            Flash::error('User Teacher not found');

            return redirect(route('userTeachers.index'));
        }

        $this->userTeacherRepository->delete($id);

        Alert::success('User Teacher deleted successfully.');

        return redirect(route('userTeachers.index'));
    }
}
