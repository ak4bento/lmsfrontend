<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserStudentRequest;
use App\Http\Requests\UpdateUserStudentRequest;
use App\Repositories\ClassroomUserRepository;
use App\Repositories\UserStudentRepository;
use App\Repositories\ProfileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;

class UserStudentController extends AppBaseController
{
    /** @var  UserStudentRepository */
    private $userStudentRepository;

    /** @var  ClassroomUserRepository */
    private $ClassroomUserRepository;

    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(UserStudentRepository $userStudentRepo,ClassroomUserRepository $ClassroomUserRepo, ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
        $this->ClassroomUserRepository = $ClassroomUserRepo;
        $this->userStudentRepository = $userStudentRepo;
    }

    /**
     * Display a listing of the UserStudent.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userStudents = $this->userStudentRepository->all();

        return view('user_students.index')
            ->with('userStudents', $userStudents);
    }

    /**
     * Show the form for creating a new UserStudent.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_students.create');
    }

    /**
     * Store a newly created UserStudent in storage.
     *
     * @param CreateUserStudentRequest $request
     *
     * @return Response
     */
    public function store(CreateUserStudentRequest $request)
    {
        $input = $request->all();

        $userStudent = $this->userStudentRepository->create($input);
        
        $input = $request->all();
        
        $input['user_id'] = $userStudent['id'];
        
        $profile = $this->profileRepository->create($input);

        Flash::success('User Student saved successfully.');

        return redirect(route('userStudents.index'));
    }

    /**
     * Display the specified UserStudent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userStudent = $this->userStudentRepository->find($id);
        // dd($id);
        $classroom_users = $this->ClassroomUserRepository->allQuery(['user_id',$id])->get(); 
        
        $classroom_users = DB::table('classroom_user') 
            ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
            ->select('classrooms.*' )
            ->where('user_id',$id)
            ->get();
        // dd($classroom_users);
        if (empty($userStudent)) {
            Flash::error('User Student not found');

            return redirect(route('userStudents.index'));
        }
        return view('user_students.show')->with('userStudent', $userStudent)->with('classroom_users', $classroom_users);
    }

    /**
     * Show the form for editing the specified UserStudent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userStudent = $this->userStudentRepository->find($id);
        $profile = $this->profileRepository->allQuery(['user_id'=> $id])->first(); 
        if (empty($userStudent)) {
            Flash::error('User Student not found');

            return redirect(route('userStudents.index'));
        }
        // dd($profile);
        return view('user_students.edit')->with('userStudent', $userStudent)->with('profile', $profile);
    }

    /**
     * Update the specified UserStudent in storage.
     *
     * @param int $id
     * @param UpdateUserStudentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserStudentRequest $request)
    {
        $data = $request->all();
        $userStudent = $this->userStudentRepository->find($id);
        dd($data);
        if($model['password'] == null){
            $model['password'] = $data['password'];
        }
        else{
            $model['password'] = Hash::make($model['password']);
        }

        if (empty($userStudent)) {
            Flash::error('User Student not found');

            return redirect(route('userStudents.index'));
        }

        $userStudent = $this->userStudentRepository->update($data, $id);

        Flash::success('User Student updated successfully.');

        return redirect(route('userStudents.index'));
    }

    /**
     * Remove the specified UserStudent from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userStudent = $this->userStudentRepository->find($id);

        if (empty($userStudent)) {
            Flash::error('User Student not found');

            return redirect(route('userStudents.index'));
        }

        $this->userStudentRepository->delete($id);

        Flash::success('User Student deleted successfully.');

        return redirect(route('userStudents.index'));
    }
}
