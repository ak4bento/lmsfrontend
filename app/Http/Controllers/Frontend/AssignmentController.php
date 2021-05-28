<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Repositories\AssignmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Alert;
use App\Repositories\TeachableRepository;
use App\Models\TeachableUser;
use App\Models\ClassroomUser;
use App\Repositories\GradeRepository;
use Auth;
use App\Models\Grade;
use Validator;

class AssignmentController extends AppBaseController
{
    /** @var  AssignmentRepository */
    private $assignmentRepository;
    private $teachableRepository;
    private $gradeRepository;

    public function __construct(TeachableRepository $teachableRepo,AssignmentRepository $assignmentRepo,GradeRepository $gradeRepo)
    {
        $this->gradeRepository = $gradeRepo;
        $this->teachableRepository = $teachableRepo;
        $this->assignmentRepository = $assignmentRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($slug, $id)
    {
        $assignments = DB::table('assignments')->where('id',$id)->where('deleted_at',null)->select('*')->first();
        $media = DB::table('media')->where('media_type','assigment',)->where('media_id',$id)->select('*')->get();
        // dd($assignments);
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();

        return view('frontend.teacher.assignment.index')->with('assignments',$assignments)->with('media',$media)->with('classrooms',$classrooms);

    }

    public function gradeStore(Request $request,$slug)
    {
        $input = $request->all();
        $validated = $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);
        $input['gradeable_id']  = $input['id'];
        $input['comments']      = '-';
        $input['gradeable_type']= 'media';
        $input['graded_by']     = Auth::user()->id;
        $grade = Grade::where('gradeable_id',$input['gradeable_id'])->where('gradeable_type','media')->select('*')->first();
        if($grade != null){
            $this->gradeRepository->update($input, $grade->id);
            Alert::success('Nilai Berhasil Diperbaharui.');

        }else{
            $grade = $this->gradeRepository->create($input);
            Alert::success('Nilai Berhasil Ditambahkan.');
        }
        return redirect()->route('allAssignment', ['slug'=>$slug, 'id'=>$input['media_id']]);

    }

    public function create($slug)
    {
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();

        if(is_null($classrooms)){
            abort(404);
        }

        $classroomUser = ClassroomUser::where('classroom_id', $classrooms->id)->where('deleted_at', null)->get();
        $user = DB::table('classroom_user')
                    ->join('users', 'users.id', '=', 'classroom_user.user_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'classroom_user.user_id')
                    ->select('classrooms.*','users.id as user_id','users.name')
                    ->where('classrooms.slug',$slug)
                    ->where('model_has_roles.role_id','!=',3)
                    ->where('model_has_roles.role_id','!=',1)
                    ->where('model_has_roles.role_id','!=',2)
                    ->where('classroom_user.deleted_at',null)
                    ->get();

        return view('frontend.teacher.assignment.create')->with('classrooms',$classrooms)->with('classroomUser',$classroomUser)->with('user',$user);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:assignments,title',
            'description' => 'required',
            'max_attempts_count' => 'required',
            'pass_threshold' => 'required',
            'available_at' => 'required',
            'expires_at' => 'required',
        ];

        $messages = [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'max_attempts_count.required' => 'Deskripsi tidak boleh kosong.',
            'pass_threshold.required' => 'Nilai Batas Minimum tidak boleh kosong.',
            'expires_at.required' => 'Selesai tidak boleh kosong.',
            'available_at.required'=> 'Mulai tidak boleh kosong.',
            'max_attempts_count.numeric'=> 'Jumlah maksimal mencoba harus berupa angka.',
            'max_attempts_count.min'=> 'Jumlah maksimal mencoba minimal 1.',
            'max_attempts_count.max'=> 'Jumlah maksimal mencoba minimal 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;

        $assignment = $this->assignmentRepository->create($input);
        $input['teachable_type'] = "assignments";
        $input['teachable_id'] = $assignment['id'];
        $input['classroom_id'] = $input['classroom_id'];
        $teachable = $this->teachableRepository->create($input);
        if(isset($input['user_id'])){
            foreach($input['user_id'] as $user_id){
                $ClassroomUser = ClassroomUser::where('classroom_id',$input['classroom_id'])->where('user_id',$user_id)->first();
                if($ClassroomUser){
                    $data['classroom_user_id'] = $ClassroomUser['id'];
                    $data['teachable_id'] = $teachable['id'];
                    TeachableUser::create($data);
                }
            }
        }
        Alert::success('Assignment saved successfully.');
        return redirect()->route('classroom.detail', $input['slug']);
    }

    public function edit($slug,$id)
    {
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        if(is_null($classrooms)){
            abort(404);
        }
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('teachables.*')->first();
        $assignments = DB::table('assignments')->where('id',$id)->where('deleted_at',null)->select('assignments.*')->first();
        $classroomUser = ClassroomUser::where('classroom_id', $classrooms->id)->where('deleted_at', null)->get();
        $user = DB::table('classroom_user')
                    ->join('users', 'users.id', '=', 'classroom_user.user_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'classroom_user.user_id')
                    ->select('classrooms.*','users.id as user_id','users.name','classroom_user.id as classroom_user_id')
                    ->where('classrooms.slug',$slug)
                    ->where('classroom_user.deleted_at',null)
                    ->where('model_has_roles.role_id','!=',3)
                    ->where('model_has_roles.role_id','!=',1)
                    ->where('model_has_roles.role_id','!=',2)
                    ->get();
        $teachableUser = DB::table('teachable_users')
                    ->join('classroom_user', 'classroom_user.id', '=', 'teachable_users.classroom_user_id')
                    ->join('teachables', 'teachables.id', '=', 'teachable_users.teachable_id')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'classroom_user.user_id')
                    ->select('classroom_user.*')
                    ->where('teachable_users.teachable_id',$teachable->id)
                    ->where('teachable_users.deleted_at',null)
                    ->where('model_has_roles.role_id','!=',3)
                    ->get();
                    // dd($teachableUser);
        return view('frontend.teacher.assignment.edit')
                ->with('classrooms',$classrooms)
                ->with('teachable',$teachable)
                ->with('assignments',$assignments)
                ->with('user',$user)
                ->with('teachableUser',$teachableUser);
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $rules = [
            'title' => "required|unique:assignments,title,$id",
            'description' => 'required',
            'max_attempts_count' => 'required|numeric|min:1|max:5',
            'pass_threshold' => 'required',
            'available_at' => 'required',
            'expires_at' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.unique'=> 'Kode harus unik atau tidak boleh sama.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'max_attempts_count.required' => 'Deskripsi tidak boleh kosong.',
            'pass_threshold.required' => 'Nilai Batas Minimum tidak boleh kosong.',
            'expires_at.required' => 'Selesai tidak boleh kosong.',
            'available_at.required'=> 'Mulai tidak boleh kosong.',
            'max_attempts_count.numeric'=> 'Jumlah maksimal mencoba harus berupa angka.',
            'max_attempts_count.min'=> 'Jumlah maksimal mencoba minimal 1.',
            'max_attempts_count.max'=> 'Jumlah maksimal mencoba minimal 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('*')->first();
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;

        $assignment = $this->assignmentRepository->update($input, $id);

        $input['teachable_type'] = "assignments";
        $input['teachable_id'] = $id;
        $input['classroom_id'] = $input['classroom_id'];

        $teachable = $this->teachableRepository->update($input, $teachable->id);
        if(isset($input['user_id'])){
            foreach($input['user_id'] as $user_id){
                $ClassroomUser = ClassroomUser::where('classroom_id',$input['classroom_id'])->where('user_id',$user_id)->first();
                if($ClassroomUser){
                    $value['classroom_user_id'] = $ClassroomUser['id'];
                    $value['teachable_id'] = $teachable['id'];
                    $deleted_at['deleted_at'] = date('d/m/Y H:i:s');
                    $TeachableUser = TeachableUser::where('teachable_id',$value['teachable_id'])->delete();
                    TeachableUser::create($value);
                }
            }
            foreach($input['user_id'] as $user_id){
                $ClassroomUser = ClassroomUser::where('classroom_id',$input['classroom_id'])->where('user_id',$user_id)->first();
                $value['classroom_user_id'] = $ClassroomUser['id'];
                $value['teachable_id'] = $teachable['id'];
                TeachableUser::create($value);
            }
        }else{
            $TeachableUser = TeachableUser::where('teachable_id',$teachable['id'])->delete();
        }
        Alert::success('Assignment saved successfully.');
        return redirect()->route('classroom.detail', $input['slug']);
    }

    public function destroy($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }
        $teachable  = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('*')->first();
        $classrooms = DB::table('classrooms')->select('*')->where('id',$teachable->classroom_id)->first();
        $this->assignmentRepository->delete($id);
        $this->teachableRepository->delete($teachable->id);

        Alert::success('Assignment deleted successfully.');
        return redirect()->route('classroom.detail', $classrooms->slug);
    }
}
