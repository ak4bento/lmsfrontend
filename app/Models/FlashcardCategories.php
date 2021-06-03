<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardCategories
 * @package App\Models
 * @version May 19, 2021, 6:56 am UTC
 *
 * @property integer $parent_id
 * @property string $category
 */
class FlashcardCategories extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'parent_id',
        'second_parent_id',
        'third_parent_id',
        'count_question',
        'level',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'second_parent_id' => 'integer',
        'third_parent_id' => 'integer',
        'count_question' => 'integer',
        'level' => 'integer',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable|integer',
        'second_parent_id' => 'nullable|integer',
        'third_parent_id' => 'nullable|integer',
        'level' => 'integer',
        'category' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    // public function getCountQuestionAttribute()
    // {
    //     $flashCategory = FlashcardCategories::where('parent_id',$this->id)->where('level',4)->get();

    //     // return $flashCategory;

    //     $level4 = array();
    //     $level3 = array();
    //     $level2 = array();
    //     foreach ($flashCategory as $key) {
    //         array_push($level4, array(FlashcardCategories::where('id', $key->id)->first()->category => FlashcardCategoriesQuestion::where('flashcard_categories_id',$key->id)->count()));
    //         array_push($level3,FlashcardCategories::where('id', $key->id)->get());
    //     }

    //    foreach ($level3 as $value) {
    //         array_push($level3, array(FlashcardCategories::where('id', $key->id)->first()->category => FlashcardCategoriesQuestion::where('flashcard_categories_id',$key->id)->count()));
           
    //    }
       
    //     return $level3;
    // }

}
