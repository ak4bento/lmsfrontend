<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardCategories;
use Response;
use DB;
use Auth;

class FlashcardCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $flashcardCategories = FlashcardCategories::where('deleted_at',null)->where('parent_id',null)->get();
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.first_parent_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',1)
                    ->get();
        // dd($flashcardCategories);
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
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.second_parent_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',2)
                    ->where('flashcard_categories.parent_id',$id)
                    ->get();
        // dd($flashcardCategories);
        return Response::json($flashcardCategories);
    }

    public function second_categories($id)
    { 
        // $flashcardCategories = DB::table("flashcard_categories")
        //         ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.second_parent_id','=','flashcard_categories.id')
        //         ->leftJoin('flashcard_answers', 'flashcard_answers.flashcard_questions_id', '=', 'flashcard_categories_questions.flashcard_questions_id')
        //         ->select("flashcard_categories.*",
        //                     DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"),
        //                     // DB::raw("count(flashcard_answers.id) as answer_count"),
        //                     // DB::raw("count(IF(flashcard_answers.user_id == 1)) as answer_count")
        //         )
        //         ->selectRaw("count(case when flashcard_answers.user_id = '5' then 1 end) as answer_count")
        //         ->whereNull("flashcard_categories.deleted_at")
        //         ->where("flashcard_categories.level", "=", 2) 
        //         ->where("flashcard_categories.parent_id", "=", $id)
        //         // ->where('flashcard_answers.user_id', Auth::user()->id)
        //         ->groupBy('flashcard_categories.id')
        //         // ->groupBy('flashcard_categories_questions.second_parent_id')
        //         ->get();
         
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.second_parent_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',2)
                    ->where('flashcard_categories.parent_id',$id)
                    ->get();
        // dd($flashcardCategories);

        return Response::json($flashcardCategories);
    }

    public function second_categories_answer($id)
    {
        $flashcardCategoriesCountAnswer = DB::table('flashcard_categories_questions')
                    ->join('flashcard_answers','flashcard_answers.flashcard_questions_id','=','flashcard_categories_questions.flashcard_questions_id')
                    ->select('flashcard_answers.*')
                    ->where('flashcard_categories_questions.deleted_at',null)
                    ->where('flashcard_categories_questions.second_parent_id',$id)
                    ->where('flashcard_answers.user_id',Auth::user()->id)
                    ->get();
        
        return Response::json(count($flashcardCategoriesCountAnswer));
        
    }

    public function third_categories_answer($id)
    {
        $flashcardCategoriesCountAnswer = DB::table('flashcard_categories_questions')
                    ->join('flashcard_answers','flashcard_answers.flashcard_questions_id','=','flashcard_categories_questions.flashcard_questions_id')
                    ->select('flashcard_answers.*')
                    ->where('flashcard_categories_questions.deleted_at',null)
                    ->where('flashcard_categories_questions.third_parent_id',$id)
                    ->where('flashcard_answers.user_id',Auth::user()->id)
                    ->get();
        
        return Response::json(count($flashcardCategoriesCountAnswer));
        
    }
    public function fourth_categories_answer($id)
    {
        $flashcardCategoriesCountAnswer = DB::table('flashcard_categories_questions')
                    ->join('flashcard_answers','flashcard_answers.flashcard_questions_id','=','flashcard_categories_questions.flashcard_questions_id')
                    ->select('flashcard_answers.*')
                    ->where('flashcard_categories_questions.deleted_at',null)
                    ->where('flashcard_categories_questions.flashcard_categories_id',$id)
                    ->where('flashcard_answers.user_id',Auth::user()->id)
                    ->get();
        
        return Response::json($flashcardCategoriesCountAnswer);
    }


    public function third_categories($id)
    {
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.third_parent_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',3)
                    ->where('flashcard_categories.second_parent_id',$id)
                    ->get();

        return Response::json($flashcardCategories);
    }

    public function fourth_categories($id)
    {
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.flashcard_categories_id','=','flashcard_categories.id')
                    // ->join('flashcard_answers', 'flashcard_answers.flashcard_questions_id', '=', 'flashcard_categories_questions.flashcard_questions_id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',4)
                    ->where('flashcard_categories.third_parent_id',$id)
                    ->get();

        return Response::json($flashcardCategories);
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

    public function selected_answer_count(Request $request)
    {
        $quiz = $request->all();
        $quiz = json_decode($quiz['value']);
        $first_categorys  = "";
        $second_categorys = "";
        $third_categorys  = "";
        $fourth_category  = "";
        $origin           = array();
        $data_category    = array();

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
                array_push($data_category,$origin);
            } else if($category->level == 3){
                $third_categorys = FlashcardCategories::where('third_parent_id',$category->id)->get();
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
                $second_categorys = FlashcardCategories::where('second_parent_id',$category->id)->get();
                foreach($second_categorys as $second_category){
                    $origin = array(
                        'id' => $second_category['id'],
                        'parent_id' => $second_category['parent_id'],
                        'level' => $second_category['level'],
                        'category' => $second_category['category'],
                    );
                    array_push($data_category,$origin);
                }
            } else {
                $first_categorys  = FlashcardCategories::where('parent_id',$category->id)->get(); 
                foreach ($first_categorys as $first_category) {
                    $origin = array(
                        'id' => $first_category['id'],
                        'parent_id' => $first_category['parent_id'],
                        'level' => $first_category['level'],
                        'category' => $first_category['category'],
                    );
                    array_push($data_category,$origin);
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
        return Response::json($questions);

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

    public function selected_count(Request $request)
    {
        $data = $request->all();
        // $json = json_decode($data['data']);
        // return $data;
        // $field= "";
        if(isset($data['id'])){

            $field1="";
            if($data['level'] == 4){
                $field1 = "flashcard_categories_questions.flashcard_categories_id";
                $field = "flashcard_categories.third_parent_id";
            } else if($data['level'] == 3){
                $field1 = "flashcard_categories_questions.third_parent_id";
                $field = "flashcard_categories.second_parent_id";
            } else if($data['level'] == 2){
                $field1 = "flashcard_categories_questions.second_parent_id";
                $field = "flashcard_categories.parent_id";
            } else {
                $field1 = 'flashcard_categories_questions.first_parent_id';
                $field = "flashcard_categories.parent_id";
                // $data['id'] = null;
            }
            // return $field1;
            $flashcardCategories = DB::table('flashcard_categories')
                        ->leftJoin('flashcard_categories_questions',$field1,'=','flashcard_categories.id')
                        ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                        ->groupBy('flashcard_categories.id')
                        ->where('flashcard_categories.deleted_at',null)
                        ->where('flashcard_categories.level',$data['level'])
                        ->where('flashcard_categories.id',$data['id'])
                        ->first();
            if($data['level'] == 1 ){
                $flashcardCategories = DB::table('flashcard_categories')
                        ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.first_parent_id','=','flashcard_categories.id')
                        ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                        ->groupBy('flashcard_categories.id')
                        ->where('flashcard_categories.deleted_at',null)
                        ->where('flashcard_categories.level',1)
                        ->where('flashcard_categories.id',$data['id'])
                        ->first();
            }
            $all_data = array('flashcardCategories'=>$flashcardCategories,'questions'=>0);

        }


        if(isset($data['value'])){
            $quiz = json_decode($data['value']);
            $first_categorys  = "";
            $second_categorys = "";
            $third_categorys  = "";
            $fourth_category  = "";
            $origin           = array();
            $data_category    = array();
    
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
                    array_push($data_category,$origin);
                } else if($category->level == 3){
                    $third_categorys = FlashcardCategories::where('third_parent_id',$category->id)->get();
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
                    $second_categorys = FlashcardCategories::where('second_parent_id',$category->id)->get();
                    foreach($second_categorys as $second_category){
                        $origin = array(
                            'id' => $second_category['id'],
                            'parent_id' => $second_category['parent_id'],
                            'level' => $second_category['level'],
                            'category' => $second_category['category'],
                        );
                        array_push($data_category,$origin);
                    }
                } else {
                    $first_categorys  = FlashcardCategories::where('parent_id',$category->id)->get(); 
                    foreach ($first_categorys as $first_category) {
                        $origin = array(
                            'id' => $first_category['id'],
                            'parent_id' => $first_category['parent_id'],
                            'level' => $first_category['level'],
                            'category' => $first_category['category'],
                        );
                        array_push($data_category,$origin);
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
            $user_id = 4;
            $questions =  DB::table('flashcard_categories_questions')
                                    ->join('flashcard_categories', 'flashcard_categories.id', '=', 'flashcard_categories_questions.flashcard_categories_id')
                                    ->join('flashcard_questions', 'flashcard_questions.id', '=', 'flashcard_categories_questions.flashcard_questions_id')
                                    ->join('flashcard_answers', 'flashcard_answers.flashcard_questions_id', '=', 'flashcard_categories_questions.flashcard_questions_id')
                                    ->select('flashcard_questions.*','flashcard_answers.user_id')  
                                    ->where('flashcard_answers.user_id',$user_id)
                                    
                                    ->whereIn('flashcard_categories_questions.flashcard_categories_id', $id)->get();
    
            
            $all_data = array('flashcardCategories'=>$flashcardCategories,'questions'=>count($questions));
        }
        
        return Response::json($all_data);
    }

    public function unselected($id)
    {
        $data = FlashcardCategories::find($id);
        if($data->level == 3){
            $data = FlashcardCategories::where('third_parent_id', $data->id)->get();
        }else if($data->level == 2){
            $data = FlashcardCategories::where('second_parent_id', $data->id)->get();
        }else if($data->level == 1){
            $data = FlashcardCategories::where('parent_id', $data->id)->get();
        }
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

    public function json($id)
    {
        return Response::json(FlashcardCategories::find($id)->count_question);
    }
}
