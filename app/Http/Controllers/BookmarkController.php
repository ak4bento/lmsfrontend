<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;
use App\Repositories\BookmarkRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
    public function index(Request $request)
    {
        $bookmarks = $this->bookmarkRepository->all();

        return view('bookmarks.index')
            ->with('bookmarks', $bookmarks);
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
    public function store(CreateBookmarkRequest $request)
    {
        $input = $request->all();

        $bookmark = $this->bookmarkRepository->create($input);

        Flash::success('Bookmark saved successfully.');

        return redirect(route('bookmarks.index'));
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
    public function destroy($id)
    {
        $bookmark = $this->bookmarkRepository->find($id);

        if (empty($bookmark)) {
            Flash::error('Bookmark not found');

            return redirect(route('bookmarks.index'));
        }

        $this->bookmarkRepository->delete($id);

        Flash::success('Bookmark deleted successfully.');

        return redirect(route('bookmarks.index'));
    }
}
