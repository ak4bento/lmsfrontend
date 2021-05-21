<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardQuestionsSubject
 * @package App\Models
 * @version May 21, 2021, 7:24 am UTC
 *
 * @property integer $flashcard_questions_id
 * @property integer $flashcard_subjects_id
 */
class FlashcardQuestionsSubject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_questions_subjects';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'flashcard_questions_id',
        'flashcard_subjects_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'flashcard_questions_id' => 'integer',
        'flashcard_subjects_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'flashcard_questions_id' => 'required|integer',
        'flashcard_subjects_id' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
