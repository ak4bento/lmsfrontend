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

class AssignmentController extends AppBaseController
{
    /** @var  AssignmentRepository */
    private $assignmentRepository; 
    private $teachableRepository;

    public function __construct(TeachableRepository $teachableRepo,AssignmentRepository $assignmentRepo)
    {
        $this->teachableRepository = $teachableRepo;
        $this->assignmentRepository = $assignmentRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    { 
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        return view('frontend.teacher.assignment.create')->with('classrooms',$classrooms);
    }

    public function store(Request $request)
    { 
        $validated = $request->validate([
            'title' => 'required|unique:assignments,title',
        ]);
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;

        // dd($input);
        $assignment = $this->assignmentRepository->create($input);
        $input['teachable_type'] = "assignment";
        $input['teachable_id'] = $assignment['id'];
        $input['classroom_id'] = $input['classroom_id'];
        
        $teachable = $this->teachableRepository->create($input); 

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
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('teachables.*')->first();
        $assignments = DB::table('assignments')->where('id',$id)->where('deleted_at',null)->select('assignments.*')->first();
        // dd($teachable);
        return view('frontend.teacher.assignment.edit')->with('classrooms',$classrooms)->with('teachable',$teachable)->with('assignments',$assignments);
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $validated = $request->validate([
            'title' => 'required',
        ]);
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('*')->first();
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;

        $assignment = $this->assignmentRepository->update($input, $id);
        
        $input['teachable_type'] = "assignment";
        $input['teachable_id'] = $id;
        $input['classroom_id'] = $input['classroom_id'];
        
        $teachable = $this->teachableRepository->update($input, $teachable->id);
        // dd($input);


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