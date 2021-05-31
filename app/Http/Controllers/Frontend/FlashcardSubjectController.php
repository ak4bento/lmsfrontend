<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardQuestion;
use App\Models\FlashcardSubject;
use App\Models\FlashcardQuestionsSubject;
use Response;
use DB;

class FlashcardSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $subjects = DB::table('flashcard_questions_subjects')
                                ->join('flashcard_subjects', 'flashcard_subjects.id', '=', 'flashcard_questions_subjects.flashcard_subjects_id')
                                ->join('flashcard_questions', 'flashcard_questions.id', '=', 'flashcard_questions_subjects.flashcard_questions_id')
                                ->select('flashcard_subjects.*') 
                                ->where('flashcard_questions_subjects.flashcard_questions_id', $id)->get();
        
        return Response::json($subjects);
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
        $subjects = DB::table('flashcard_questions_subjects')
                        ->join('flashcard_subjects', 'flashcard_subjects.id', '=', 'flashcard_questions_subjects.flashcard_subjects_id')
                        ->join('flashcard_questions', 'flashcard_questions.id', '=', 'flashcard_questions_subjects.flashcard_questions_id')
                        ->select('flashcard_subjects.*') 
                        ->where('flashcard_questions_subjects.flashcard_subjects_id', $id)->first();

        return Response::json($subjects);
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
