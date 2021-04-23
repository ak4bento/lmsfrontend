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

class QuezzesController extends AppBaseController
{
    /** @var  QuizzesRepository */
    private $QuizzesRepository; 
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
    public function create($slug)
    { 
        $classroom = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        return view('frontend.teacher.quezzes.create')->with('classroom',$classroom);
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

        return redirect(route('showAllQuestion',['slug'=>$input['slug'],'id'=>$quizzes->id]));

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

        $assignment = $this->QuizzesRepository->update($input, $id);
        
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
        $assignment = $this->QuizzesRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }
        $teachable  = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','assignment')->where('deleted_at',null)->select('*')->first();
        $classrooms = DB::table('classrooms')->select('*')->where('id',$teachable->classroom_id)->first();
        $this->QuizzesRepository->delete($id);
        $this->teachableRepository->delete($teachable->id);

        Alert::success('Assignment deleted successfully.');
        return redirect()->route('classroom.detail', $classrooms->slug);
    }
}
