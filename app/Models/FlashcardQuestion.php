<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardQuestion
 * @package App\Models
 * @version May 19, 2021, 6:57 am UTC
 *
 * @property integer $flashcard_categories_id
 * @property string $question
 * @property string $images
 * @property string $explanation
 * @property string $images_explanation
 */
class FlashcardQuestion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_questions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'flashcard_categories_id',
        'question',
        'images',
        'explanation',
        'images_explanation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'flashcard_categories_id' => 'integer',
        'question' => 'string',
        'images' => 'string',
        'explanation' => 'string',
        'images_explanation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'flashcard_categories_id' => 'required|integer',
        'question' => 'required|string|max:191',
        'explanation' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
