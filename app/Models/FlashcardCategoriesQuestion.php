<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardCategoriesQuestion
 * @package App\Models
 * @version May 21, 2021, 7:22 am UTC
 *
 * @property integer $flashcard_questions_id
 * @property integer $flashcard_categories_id
 */
class FlashcardCategoriesQuestion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_categories_questions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'flashcard_questions_id',
        'flashcard_categories_id'
    ];

    public function flashcard_categories()
    {
        return $this->hasMany('App\Models\FlashcardCategories','flashcard_categories_id','id');
    }
    
    public function flashcard_questions()
    {
        return $this->hasMany('App\Models\FlashcardQuestion','flashcard_questions_id','id');
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'flashcard_questions_id' => 'integer',
        'flashcard_categories_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'flashcard_questions_id' => 'required|integer',
        'flashcard_categories_id' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
