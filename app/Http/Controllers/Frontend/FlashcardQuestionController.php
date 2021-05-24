<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardQuestion;
use App\Models\FlashcardCategoriesQuestion;
use Response;
use App\Models\FlashcardCategories;

class FlashcardQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function start(Request $request)
    {
        $quiz = $request->all();

        $quiz = json_decode($quiz['data']);

        $first_categorys     = "";
        $second_categorys    = "";
        $third_categorys     = "";
        $fourth_category    = "";
        $data_category = 0;

        foreach ($quiz as $key => $value) {
            $category = FlashcardCategories::where('id',$key)->first();
            if($category->level == 4){
                $data_category = array_push($data_category, $category);
            } else if($category->level == 3){
                $third_categorys = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach ($third_categorys as $third_category) {
                    dd($third_category);
                    $data_category = array_push($data_category, $third_category);
                }
            } else if($category->level == 2){
                $second_categorys = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach($second_categorys as $second_category){
                    $third_categorys = FlashcardCategories::where('parent_id',$second_category->id)->get();
                    foreach ($third_categorys as $third_category) {
                        dd($third_category);
                        $data_category = array_push($data_category, $third_category);
                    }
                }
            } else {
                $first_categorys  = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach ($first_categorys as $first_category) {
                    $second_categorys = FlashcardCategories::where('parent_id',$first_category->id)->get();
                    foreach($second_categorys as $second_category){
                        $third_categorys = FlashcardCategories::where('parent_id',$second_category->id)->get();
                        foreach ($third_categorys as $third_category) {
                            dd($data_category);
                            $data_category = array_push($data_category, $third_category);
                        }
                    }
                }
            }             
        }
        return view('frontend.flashcard.quiz')->with('quiz', $quiz);
    }

    public function index()
    {
        //
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
        //
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
