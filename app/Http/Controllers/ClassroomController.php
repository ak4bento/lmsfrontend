<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Repositories\ClassroomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Alert;
use Illuminate\Support\Str;

class ClassroomController extends AppBaseController
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
    }

    /**
     * Display a listing of the Classroom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $classrooms = $this->classroomRepository->all();

        return view('classrooms.index')
            ->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new Classroom.
     *
     * @return Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created Classroom in storage.
     *
     * @param CreateClassroomRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomRequest $request)
    {
        $rules = [
            'title' => "required|unique:classrooms,title|max:35",
            'code' => "max:10|unique:classrooms,code",
            'description' => 'max:120',
        ];

        $messages = [
            'title.required' => 'Kelas tidak boleh kosong.',
            'description.max' => 'Deskripsi maksimal 120 karakter.',
            'code.max'=> 'Kode maksimal 10 karakter.',
            'code.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'title.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'title.max'=> 'Kelas maksimal 35 karakter.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            
        $input = $request->all();
        $input['created_by']=auth()->user()->id; 
        $input['slug'] = Str::slug($request->title); 

        $classroom = $this->classroomRepository->create($input);

        Alert::success('Classroom saved successfully.');

        return redirect(route('classrooms.index'));
    }

    /**
     * Display the specified Classroom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        return view('classrooms.show')->with('classroom', $classroom);
    }

    /**
     * Show the form for editing the specified Classroom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        return view('classrooms.edit')->with('classroom', $classroom);
    }

    /**
     * Update the specified Classroom in storage.
     *
     * @param int $id
     * @param UpdateClassroomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomRequest $request)
    {
        $classroom = $this->classroomRepository->find($id);
        $input = $request->all();
        $input['created_by']=auth()->user()->id;
        $input['slug'] = Str::slug($request->title); 
 
        $rules = [
            'title' => "required|unique:classrooms,title,$id|max:35",
            'code' => "max:10|unique:classrooms,code,$id",
            'description' => 'max:120|required',
        ];
        

        $messages = [
            'title.required' => 'Kelas tidak boleh kosong.',
            'description.max' => 'Deskripsi maksimal 120 karakter.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'code.max'=> 'Kode maksimal 10 karakter.',
            'code.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'title.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'title.max'=> 'Kelas maksimal 35 karakter.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        $classroom = $this->classroomRepository->update($input, $id);

        Alert::success('Classroom updated successfully.');

        return redirect(route('classrooms.index'));
    }

    /**
     * Remove the specified Classroom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        $this->classroomRepository->delete($id);
        Alert::success('Berhasil', 'Data Berhasil dihapus');

        // Alert::success('Classroom deleted successfully.');

        return redirect(route('classrooms.index'));
    }

    public function getClassroom($id)
    { 
        $classroom = DB::table('classrooms') 
            ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
            ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
            ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
            ->where('classrooms.id',$id)
            ->first();

        return Response::json($classroom);
    }
}
