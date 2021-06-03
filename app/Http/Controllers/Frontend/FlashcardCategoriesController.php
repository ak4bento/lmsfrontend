<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardCategories;
use Response;
use DB;

class FlashcardCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashcardCategories = FlashcardCategories::where('deleted_at',null)->where('parent_id',null)->get();
        
        return view('frontend.flashcard.index')->with('flashcardCategories', $flashcardCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('flashcard_categories')  
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.flashcard_categories_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.parent_id',$id) 
                    ->where('flashcard_categories.level',2) 
                    ->get();
        dd($data);
        return Response::json($data);
    }

    // public function second_categories($id)
    // {
    //     $data = FlashcardCategories::where("parent_id",$id)->get();
    //     // dd($data);
    //     return Response::json($data);
    // }

    public function selected($id)
    {
        $data = FlashcardCategories::find($id);
        // dd($data);
        return Response::json($data);
    }

    public function unselected($id)
    {
        $data = FlashcardCategories::where("parent_id",$id)->get();
        
        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
