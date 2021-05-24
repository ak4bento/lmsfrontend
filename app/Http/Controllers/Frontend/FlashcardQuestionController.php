<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardQuestion;
use App\Models\FlashcardCategoriesQuestion;
use Response;
use App\Models\FlashcardCategories;
use Illuminate\Support\Arr;

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
        $origin =array(0);
        $data_category = array(
            'id' => null,
            'parent_id' => null,
            'level' => null,
            'category' => null,
        );
        foreach ($quiz as $key => $value) {
            $category = FlashcardCategories::where('id',$key)->first();
            // dd($category);
            if($category->level == 4){
                $origin = array(
                    'id' => $category['id'],
                    'parent_id' => $category['parent_id'],
                    'level' => $category['level'],
                    'category' => $category['category'],
                );
               $data_category =Arr::add($origin);
            } else if($category->level == 3){
                $third_categorys = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach ($third_categorys as $third_category) {
                    // dd($third_category);
                    $origin = array( 
                            'id' => $third_category['id'],
                            'parent_id' => $third_category['parent_id'],
                            'level' => $third_category['level'],
                            'category' => $third_category['category'],
                    ); 
                    // dd($origin);
                   $data_category =Arr::add($origin);
                }
            } else if($category->level == 2){
                $second_categorys = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach($second_categorys as $second_category){
                    $third_categorys = FlashcardCategories::where('parent_id',$second_category->id)->get();
                    foreach ($third_categorys as $third_category) {
                        $origin = array(
                            'id' => $third_category['id'],
                            'parent_id' => $third_category['parent_id'],
                            'level' => $third_category['level'],
                            'category' => $third_category['category'],
                        );
                       $data_category =Arr::add($origin);
                    }
                }
            } else {
                $first_categorys  = FlashcardCategories::where('parent_id',$category->id)->get();
                foreach ($first_categorys as $first_category) {
                    $second_categorys = FlashcardCategories::where('parent_id',$first_category->id)->get();
                    foreach($second_categorys as $second_category){
                        $third_categorys = FlashcardCategories::where('parent_id',$second_category->id)->get();
                        foreach ($third_categorys as $third_category) {
                            $origin = array(
                                'id' => $third_category['id'],
                                'parent_id' => $third_category['parent_id'],
                                'level' => $third_category['level'],
                                'category' => $third_category['category'],
                            );
                           $data_category =Arr::add($origin);
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
