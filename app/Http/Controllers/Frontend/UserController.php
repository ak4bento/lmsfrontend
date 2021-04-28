<?php

namespace App\Http\Controllers\Frontend;
 
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response; 
use DB;
use \stdClass;
use Alert;
use App\Repositories\ClassroomRepository;
use App\Repositories\ClassroomUserRepository;
use App\Models\ClassroomUser;

class UserController extends AppBaseController
{   
     /** @var  ClassroomRepository */
    private $classroomRepository;
    /** @var  ClassroomUserRepository */
    private $classroomUserRepository;

    public function __construct(ClassroomRepository $classroomRepo,ClassroomUserRepository $classroomUserRepo)
    {
        $this->classroomRepository = $classroomRepo;
        $this->classroomUserRepository = $classroomUserRepo;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($slug)
    {
        $classroom = DB::table('classrooms')
                    ->select('*')
                    ->where('slug',$slug)
                    ->where('deleted_at',null)
                    ->first();

        $classroomUser = DB::table('classroom_user')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                    ->join('users', 'users.id', '=', 'classroom_user.user_id')
                    ->select('users.name','users.email','users.id')
                    ->where('classrooms.id',$classroom->id)
                    ->get();

        return view('frontend.owner.users.index')
                ->with('classroom', $classroom)
                ->with('classroomUser', $classroomUser);
    }
    
    public function store(Request $request, $slug)
    {
        date_default_timezone_set("Asia/Makassar");

        $input = $request->all(); 
        $classroom = DB::table('classrooms')
                    ->select('*')
                    ->where('slug',$slug)
                    ->where('deleted_at',null)
                    ->first();
        
        $input['classroom_id'] = $classroom->id;
        $input['last_accesed_at'] = date('Y-m-d H:i:s');
        $classroomUser = DB::table('classroom_user') 
                    ->select('*')
                    ->where('classroom_user.classroom_id',$input['classroom_id'])
                    ->where('classroom_user.user_id',$input['user_id'])
                    ->where('classroom_user.deleted_at',null)
                    ->first();
        if($classroomUser != null){
            Alert::error('Pengajar telah terdaftar sebelumnya.');
        }else{
            ClassroomUser::create($input);
            // DB::table('model_has_roles')
            // ->where('model_id', $input['user_id'])
            // ->update(['role_id' => 3]);
            Alert::success('Pengajar berhasil ditambahkan.');
        }

        return redirect()->route('classroom.detail', $slug); 
    }

    public function destroy($slug,$id)
    {
        $classroom = DB::table('classrooms')
                    ->select('*')
                    ->where('slug',$slug)
                    ->where('deleted_at',null)
                    ->first();

        $classroomUser = DB::table('classroom_user')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_user.classroom_id')
                    ->join('users', 'users.id', '=', 'classroom_user.user_id')
                    ->select('classroom_user.*')
                    ->where('classroom_user.classroom_id',$classroom->id)
                    ->where('classroom_user.user_id',$id)
                    ->where('classroom_user.deleted_at',null)
                    ->first();
        ClassroomUser::destroy($classroomUser->id);
        Alert::success('Pengajar berhasil dihapus.');

        return redirect()->route('classroom.detail', $slug); 

    }
}
