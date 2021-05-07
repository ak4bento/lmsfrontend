<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Repositories\QuizzesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Alert;
use App\Repositories\TeachableRepository;
use App\Models\TeachableUser;
use App\Models\ClassroomUser;   
use Auth;
use Illuminate\Support\Facades\Storage;

class QuezzesController extends AppBaseController
{
    /** @var  QuizzesRepository */
    private $quizzesRepository; 
    private $teachableRepository;

    public function __construct(TeachableRepository $teachableRepo,QuizzesRepository $quizzesRepo)
    {
        $this->teachableRepository = $teachableRepo;
        $this->quizzesRepository = $quizzesRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($slug, $id)
    {
        $quizzes = DB::table('quizzes')->where('id',$id)->where('deleted_at',null)->select('*')->first();

        $classroom = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        
        $teachable = DB::table('teachables') 
                    ->select('*')
                    ->where('teachable_type','quiz')  
                    ->where('teachable_id',$id)
                    ->first();
        
        $classroom_user =  DB::table('classroom_user') 
                        ->where('classroom_id',$teachable->classroom_id)
                        ->select('*')
                        ->first();
        
        $teachableUser =  DB::table('teachable_users')   
                        ->select('*')
                        ->where('teachable_id',$teachable->id)  
                        ->get();
                    
        $quiz_attempts =  DB::table('quiz_attempts')   
                        ->select('*')
                        ->where('questions',$id)  
                        ->get();   

        return view('frontend.teacher.quezzes.index')->with('classroom',$classroom)->with('quizzes',$quizzes)->with('quiz_attempts',$quiz_attempts);
    }

    public function create($slug)
    { 
        $classroom = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        
        

        $user = DB::table('classroom_user')
                    ->join('users', 'users.id', '=', 'classroom_user.user_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'classroom_user.user_id')
                    ->select('classrooms.*','users.id as user_id','users.name')
                    ->where('classrooms.slug',$slug)
                    ->where('classroom_user.deleted_at',null)
                    ->where('model_has_roles.role_id','!=',3) 
                    ->where('model_has_roles.role_id','!=',1) 
                    ->where('model_has_roles.role_id','!=',2) 
                    ->get();
                    
        return view('frontend.teacher.quezzes.create')->with('classroom',$classroom)->with('user',$user);
    }

    public function store(Request $request)
    { 
        $input = $request->all(); 
        $input['grading_method'] = "standard";
        $input['created_by'] = auth()->user()->id;

        $quizzes = $this->quizzesRepository->create($input); 
        $input['teachable_type'] = 'quiz';
        $input['teachable_id'] = $quizzes['id'];
        $input['final_grade_weight'] = 0;
        $input['order'] = 1; 

        $teachable = $this->teachableRepository->create($input); 
        if(isset($input['user_id'])){
            foreach($input['user_id'] as $user_id){
                $ClassroomUser = ClassroomUser::where('classroom_id',$input['classroom_id'])->where('user_id',$user_id)->first();
                if($ClassroomUser){
                    $value['classroom_user_id'] = $ClassroomUser['id'];
                    $value['teachable_id'] = $teachable['id'];
                    $deleted_at['deleted_at'] = date('d/m/Y H:i:s');
                    $TeachableUser = TeachableUser::where('teachable_id',$value['teachable_id'])->delete();
                }
            } 
            foreach($input['user_id'] as $user_id){
                $ClassroomUser = ClassroomUser::where('classroom_id',$input['classroom_id'])->where('user_id',$user_id)->first();
                $value['classroom_user_id'] = $ClassroomUser['id'];
                $value['teachable_id'] = $teachable['id'];
                TeachableUser::create($value);

            }
        }
        return redirect(route('showAllQuestion',['slug'=>$input['slug'],'id'=>$quizzes->id]));

    }

    public function edit($slug,$id)
    {
        $classroom = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','quiz')->where('deleted_at',null)->select('teachables.*')->first();
        $quizzes = DB::table('quizzes')->where('id',$id)->where('deleted_at',null)->select('*')->first();
        
        // dd($teachable);
        $teachableUser = DB::table('teachable_users')
                    ->join('classroom_user', 'classroom_user.id', '=', 'teachable_users.classroom_user_id')
                    ->join('teachables', 'teachables.id', '=', 'teachable_users.teachable_id')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'classroom_user.user_id')
                    ->select('classroom_user.*')
                    ->where('teachable_users.teachable_id',$teachable->id)
                    ->where('teachable_users.deleted_at',null)
                    ->where('model_has_roles.role_id','!=',3) 
                    ->get();

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
                    

            return view('frontend.teacher.quezzes.edit')
                ->with('slug',$slug)
                ->with('classroom',$classroom)
                ->with('teachable',$teachable)
                ->with('user',$user)
                ->with('teachableUser',$teachableUser)
                ->with('quizzes',$quizzes);
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $validated = $request->validate([
            'title' => 'required',
        ]);
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','quiz')->where('deleted_at',null)->select('*')->first();
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;

        $quizzes = $this->quizzesRepository->update($input, $id);
        
        $input['teachable_type'] = "quiz";
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
        }else{
            // dd($input);
            $TeachableUser = TeachableUser::where('teachable_id',$id)->delete();
        }
        Alert::success('Quiz saved successfully.');
        return redirect()->route('classroom.detail', $input['slug']);
    }

    public function destroy($id)
    {
        $assignment = $this->quizzesRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }
        $teachable  = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','quiz')->where('deleted_at',null)->select('*')->first();
        $classrooms = DB::table('classrooms')->select('*')->where('id',$teachable->classroom_id)->first();
        $this->quizzesRepository->delete($id);
        $this->teachableRepository->delete($teachable->id);

        Alert::success('Quiz deleted successfully.');
        return redirect()->route('classroom.detail', $classrooms->slug);
    }
}
