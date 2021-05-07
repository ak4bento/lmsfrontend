<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CreateBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;
use App\Repositories\BookmarkRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Bookmark;
use DB;
use Auth;

class BookmarkController extends AppBaseController
{
    /** @var  BookmarkRepository */
    private $bookmarkRepository;

    public function __construct(BookmarkRepository $bookmarkRepo)
    {
        $this->bookmarkRepository = $bookmarkRepo;
    }

    /**
     * Display a listing of the Bookmark.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $teachables = DB::table('bookmarks')
                    ->join('teachables', 'teachables.id', '=', 'bookmarks.teachable_id')
                    ->select('teachables.*')
                    ->where('teachables.deleted_at',null) 
                    ->where('bookmarks.user_id',Auth::user()->id) 
                    ->get();  
        // dd($teachables);
        return view('frontend.users.backpack')->with('teachables',$teachables); 
        
    }

    /**
     * Show the form for creating a new Bookmark.
     *
     * @return Response
     */
    public function create()
    {
        return view('bookmarks.create');
    }

    /**
     * Store a newly created Bookmark in storage.
     *
     * @param CreateBookmarkRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $bookmark = $this->bookmarkRepository->create($input);
         
        $data = array(
            'status' => 200,
            'data' => $bookmark
        );
        return Response::json($data);
    }

    /**
     * Display the specified Bookmark.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bookmark = $this->bookmarkRepository->find($id);

        if (empty($bookmark)) {
            Flash::error('Bookmark not found');

            return redirect(route('bookmarks.index'));
        }

        return view('bookmarks.show')->with('bookmark', $bookmark);
    }

    /**
     * Show the form for editing the specified Bookmark.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookmark = $this->bookmarkRepository->find($id);

        if (empty($bookmark)) {
            Flash::error('Bookmark not found');

            return redirect(route('bookmarks.index'));
        }

        return view('bookmarks.edit')->with('bookmark', $bookmark);
    }

    /**
     * Update the specified Bookmark in storage.
     *
     * @param int $id
     * @param UpdateBookmarkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookmarkRequest $request)
    {
        $bookmark = $this->bookmarkRepository->find($id);

        if (empty($bookmark)) {
            Flash::error('Bookmark not found');

            return redirect(route('bookmarks.index'));
        }

        $bookmark = $this->bookmarkRepository->update($request->all(), $id);

        Flash::success('Bookmark updated successfully.');

        return redirect(route('bookmarks.index'));
    }

    /**
     * Remove the specified Bookmark from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $input = $request->all();
        $bookmark =  Bookmark::where('teachable_id',$input['teachable_id']);

        if (empty($bookmark)) {
            Flash::error('Bookmark not found');

            return redirect(route('bookmarks.index'));
        }

        DB::table('bookmarks')->where('teachable_id', $input['teachable_id'])->delete();
  
        $data = 200;
        return Response::json($data);
    }
}
