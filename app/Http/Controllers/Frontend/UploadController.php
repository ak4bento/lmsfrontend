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

class UploadController extends Controller
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
        $this->middleware('auth');
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

        $fileName = $files->getClientOriginalName();
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

        $files->move('images',$files->getClientOriginalName());

        Alert::success('File anda berhasil di unggah');

        return redirect()->back();

        // return route('class.work.detail', ['slug' => 'assignments', 'id' => $request['media_id']])->with('classWork',$classWork);
        // return view('frontend.classWork.assignments')->with('classWork',$classWork);
    }
}
