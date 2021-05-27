<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardQuestion;
use App\Models\FlashcardCategoriesQuestion;
use Response;
use App\Models\FlashcardCategories;
use Illuminate\Support\Arr;
use DB;

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

        $first_categorys  = "";
        $second_categorys = "";
        $third_categorys  = "";
        $fourth_category  = "";
        $origin           = array();
        $data_category    = array();

        foreach ($quiz as $key => $value) {
            $category = FlashcardCategories::where('id',$key)->first();
            if($category->level == 4){
                $origin = array(
                    'id' => $category['id'],
                    'parent_id' => $category['parent_id'],
                    'level' => $category['level'],
                    'category' => $category['category'],
                );
                array_push($data_category,$origin);
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
                    array_push($data_category,$origin);
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
                       array_push($data_category,$origin);
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
                            array_push($data_category,$origin);
                        }
                    }
                }
            }             
        } 
        $data_unique = $this->super_unique($data_category,'id');
        // dd($data_unique);
        $id = "";
        foreach ($data_unique as $key => $value) {
            $id = $id . $value['id'] . ",";
        }
        $id = explode(",",$id);
        // dd($id);
        $questions =  DB::table('flashcard_categories_questions')
                                ->join('flashcard_categories', 'flashcard_categories.id', '=', 'flashcard_categories_questions.flashcard_categories_id')
                                ->join('flashcard_questions', 'flashcard_questions.id', '=', 'flashcard_categories_questions.flashcard_questions_id')
                                ->select('flashcard_questions.*') 
                                ->whereIn('flashcard_categories_questions.flashcard_categories_id', $id)->get();
        //  dd($questions);
        session()->put('flashcard_question', Response::json($questions));
        // session()->pull('flashcard_question', 'default');
        session()->put('flashcard_question', json_encode( $questions));

        // dd(session()->get('flashcard_question'));
        return view('frontend.flashcard.quiz')->with('questions', $questions);
    }
    
    public function super_unique($array,$key)
    {
       $temp_array = [];
       foreach ($array as &$v) {
           if (!isset($temp_array[$v[$key]]))
           $temp_array[$v[$key]] =& $v;
       }
       $array = array_values($temp_array);
       return $array;

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
