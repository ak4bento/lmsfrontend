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
        $flashcardCategories = DB::table('flashcard_categories')
                    ->leftJoin('flashcard_categories_questions','flashcard_categories_questions.second_parent_id','=','flashcard_categories.id')
                    ->select('flashcard_categories.*' ,DB::raw("count(flashcard_categories_questions.flashcard_categories_id) as question_count"))
                    ->groupBy('flashcard_categories.id')
                    ->where('flashcard_categories.deleted_at',null)
                    ->where('flashcard_categories.level',2)
                    ->where('flashcard_categories.parent_id',$id)
                    ->get();

        return Response::json($flashcardCategories);
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

    public function selected_count(Request $request)
    {
        $data = $request->all();
        // $json = json_decode($data['data']);
        // return $data;
        // $field= "";
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



        // }
        return Response::json($flashcardCategories);
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
