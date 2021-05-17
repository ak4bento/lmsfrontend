<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Auth;
use App\Repositories\ClassroomRepository;
use DB;
use App\Models\Subject;
use App\Models\Media;
use Alert;
use Response; 

class UploadController extends Controller
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function assigment(Request $request)
    {
        $data = new Media;
        $files = $request->file('file');

        $fileName = date('Ymd').'-'.Auth::user()->id.'-'.$files->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME);

        $data['name'] = $name;
        $data['file_name'] = $fileName;
        $data['disk'] = 'public';
        $data['collection_name'] = 'files';
        $data['order_column'] = '1';
        $data['media_type'] = 'assigment';
        $data['media_id'] = $request['media_id'];
        $data['size'] = $files->getSize();
        $data['custom_properties'] = json_encode(array('user' => Auth::user()->id));
        // dd($data);

        $save = $data->save();

        $files->move('files',$fileName);

        Alert::success('File anda berhasil di unggah');

        return redirect()->back();

        // return route('class.work.detail', ['slug' => 'assignments', 'id' => $request['media_id']])->with('classWork',$classWork);
        // return view('frontend.classWork.assignments')->with('classWork',$classWork);
    }

    public function banner(Request $request, $slug)
    {
        $input = $request->all();
        $user_id = 2;
        $files = $request->file('file');
        $classrooms = DB::table('classrooms')
                    ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                    ->join('teaching_periods', 'teaching_periods.id', '=', 'classrooms.teaching_period_id')
                    ->select('classrooms.*','subjects.title as subject','teaching_periods.name as teaching_periods')
                    ->where('classrooms.slug',$slug)
                    ->where('classrooms.deleted_at',null)
                    ->first();
        $collection_name = $request->file('file')->extension();

        $input['type']   = 'image';

        $fileName = $files->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME);

        $data['name'] = $name;
        $data['file_name'] = $fileName;
        $data['disk'] = 'public';
        $data['collection_name'] = $collection_name;
        $data['order_column'] = '1';
        $data['media_type'] = 'banner';
        $data['size'] = $files->getSize();

        $data['media_id'] =$classrooms->id;
        $data['custom_properties'] = json_encode(array('user' => $user_id));

        Media::create($data);
        $files->move('files',$files->getClientOriginalName());

        return Response::json($data);
    }
}
