<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassroomUserRequest;
use App\Http\Requests\UpdateClassroomUserRequest;
use App\Repositories\ClassroomUserRepository;
use App\Repositories\ClassroomRepository;
use App\Repositories\UserStudentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Alert;
use DB;

class ClassroomUserController extends AppBaseController
{
    /** @var  ClassroomUserRepository */
    private $classroomUserRepository;
    /** @var  ClassroomRepository */
    private $classroomRepository;
    /** @var  UserStudentRepository */
    private $userStudentRepository;

    public function __construct(ClassroomUserRepository $classroomUserRepo, ClassroomRepository $classroomRepo, UserStudentRepository $userStudentRepo,)
    {
        $this->userStudentRepository = $userStudentRepo;
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
        dd($classroomUsers);
        return view('classroom_users.index')
            ->with('classroomUsers', $classroomUsers);
    }

    /**
     * Show the form for creating a new ClassroomUser.
     *
     * @return Response
     */
    public function create($id)
    {
        $userStudent = $this->userStudentRepository->find($id);
// dd($userStudent);
        return view('classroom_users.create')->with('userStudent', $userStudent);
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
        // dd($input);

        $classroomUser = $this->classroomUserRepository->create($input);

        Alert::success('Classroom User saved successfully.');

        return redirect(route('userStudents.show',[$classroomUser->user_id]));
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
        $userStudent = $this->userStudentRepository->find($classroomUser->user_id);


        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        return view('classroom_users.edit')->with('classroomUser', $classroomUser)->with('classrooms',$classrooms)->with('userStudent', $userStudent);
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
        // dd($classroomUser);
        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');

            return redirect(route('classroomUsers.index'));
        }

        $classroomUser = $this->classroomUserRepository->update($request->all(), $id);

        Alert::success('Classroom User updated successfully.'); 


        return redirect(route('userStudents.show',[$classroomUser->user_id]));
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
        // dd($classroomUser);
        $id = $classroomUser->id;  
        if (empty($classroomUser)) {
            Flash::error('Classroom User not found');
            return redirect(route('userStudents.index'));
        }
        // dd($id);

        $classroomUser = $this->classroomUserRepository->delete($id);
        Alert::success('Berhasil', 'Data Berhasil dihapus');

        // Alert::success('Classroom User deleted successfully.');
        return redirect(route('userStudents.index'));


    }
}
