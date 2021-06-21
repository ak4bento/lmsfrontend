<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardCategoriesQuestion
 * @package App\Models
 * @version June 21, 2021, 6:07 am UTC
 *
 * @property integer $flashcard_questions_id
 * @property string $first_parent_id
 * @property string $second_parent_id
 * @property string $third_parent_id
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
        'first_parent_id',
        'second_parent_id',
        'third_parent_id',
        'flashcard_categories_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'flashcard_questions_id' => 'integer',
        'first_parent_id' => 'string',
        'second_parent_id' => 'string',
        'third_parent_id' => 'string',
        'flashcard_categories_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'flashcard_questions_id' => 'required|integer',
        'first_parent_id' => 'nullable|string',
        'second_parent_id' => 'nullable|string',
        'third_parent_id' => 'nullable|string',
        'flashcard_categories_id' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
