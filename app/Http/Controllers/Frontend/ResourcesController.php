<?php

namespace App\Http\Controllers\Frontend;
 
use App\Repositories\ResourceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Alert;
use App\Repositories\TeachableRepository;
use Auth;
use App\Models\Media;

class ResourcesController extends AppBaseController
{
    /** @var  ResourceRepository */
    private $resourceRepository; 
    private $teachableRepository;

    public function __construct(TeachableRepository $teachableRepo,ResourceRepository $resourceRepo)
    {
        $this->teachableRepository = $teachableRepo;
        $this->resourceRepository = $resourceRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    { 
        // dd($slug);
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->first();
        return view('frontend.teacher.resources.create')->with('classrooms',$classrooms);
    }

    public function store(Request $request)
    { 
        $validated = $request->validate([
            'title' => 'required|unique:resources,title',
            'file' => 'required|mimes:doc,docx,pdf,mp4,mp3'
        ]);
        $input = $request->all();
        $input['type']='video';

        $data = new Media;
        $files = $request->file('file');

        $collection_name = $request->file('file')->extension();
        switch($collection_name)
        {
            case 'mp4'  : 
                $collection_name = 'video';
                $input['type']   = 'video';
                break;
            case 'mp3'  : 
                $collection_name = 'audio';
                $input['type']   = 'audio';
                break;
            default     : 
                $collection_name = 'files';
                $input['type']   = 'documents';
                break;
        }
        $fileName = $files->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME);

        $data['name'] = $name;
        $data['file_name'] = $fileName;
        $data['disk'] = 'public';
        $data['collection_name'] = $collection_name;
        $data['order_column'] = '1';
        $data['media_type'] = 'resource';
        $data['size'] = $files->getSize();
        
        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;
        $input['max_attempts_count']=1;
        $input['pass_threshold']=1;
        $input['data']='video';

        
        $resource = $this->resourceRepository->create($input);
        $input['teachable_type'] = "resource";
        $input['teachable_id'] = $resource['id'];
        $input['classroom_id'] = $input['classroom_id'];
        
        $teachable = $this->teachableRepository->create($input); 
        
        $data['media_id'] = $resource['id'];
        $data['custom_properties'] = json_encode(array('user' => Auth::user()->id));
        $save = $data->save();

        $files->move('images',$files->getClientOriginalName());

        Alert::success('Materi saved successfully.');
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
        $resources = DB::table('resources')->where('id',$id)->where('deleted_at',null)->select('resources.*')->first();
        // dd($teachable);
        return view('frontend.teacher.resources.edit')->with('classrooms',$classrooms)->with('teachable',$teachable)->with('resources',$resources);
    }

    public function update($id, Request $request)
    {  
        $teachable = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','resource')->where('deleted_at',null)->select('*')->first();
        $model = Media::where('media_type', 'resource')->where('media_id',$id)->first();
        $files = $request->file('file');
        $input = $request->all();
        $input['type']='video';

        if ($files != null) { 
            $collection_name = $request->file('file')->extension();
            switch($collection_name)
            {
                case 'mp4'  : 
                    $collection_name = 'video';
                    $input['type']   = 'video';
                    break;
                case 'mp3'  : 
                    $collection_name = 'audio';
                    $input['type']   = 'audio';
                    break;
                default     : 
                    $collection_name = 'files';
                    $input['type']   = 'documents';
                    break;
            }
            $fileName = $files->getClientOriginalName();
            $name = pathinfo($fileName, PATHINFO_FILENAME);
    
            $data['name'] = $name;
            $data['file_name'] = $fileName;
            $data['collection_name'] = $collection_name;
            $data['size'] = $files->getSize();
            $files->move('files',$files->getClientOriginalName());
        }

        $data['disk'] = 'public';
        $data['order_column'] = '1';
        $data['media_type'] = 'resource';

        $input['created_by'] = auth()->user()->id;
        $input['final_grade_weight'] = 0;
        $input['order'] = 1;
        $input['max_attempts_count']=1;
        $input['pass_threshold']=1;
        $input['data']='video';

        $resource = $this->resourceRepository->update($input, $id);
        $input['teachable_type'] = "resource";
        $input['teachable_id'] = $resource['id'];
        $input['classroom_id'] = $input['classroom_id'];
        
        $teachable = $this->teachableRepository->update($input, $teachable->id); 
        
        $data['media_id'] = $resource['id'];
        $data['custom_properties'] = json_encode(array('user' => Auth::user()->id));

        Media::find($model['id'])->update($data);

        Alert::success('Materi saved successfully.');
        return redirect()->route('classroom.detail', $input['slug']);
    }

    public function destroy($id)
    {
        $assignment = $this->resourceRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Resources not found');

            return redirect(route('assignments.index'));
        }
        $teachable  = DB::table('teachables')->where('teachable_id',$id)->where('teachable_type','resource')->where('deleted_at',null)->select('*')->first();
        $classrooms = DB::table('classrooms')->select('*')->where('id',$teachable->classroom_id)->first();
        $this->resourceRepository->delete($id);
        $this->teachableRepository->delete($teachable->id);

        Alert::success('Assignment deleted successfully.');
        return redirect()->route('classroom.detail', $classrooms->slug);
    }
}
