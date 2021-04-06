<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionQuizzes
 * @package App\Models
 * @version April 6, 2021, 2:22 am UTC
 *
 * @property integer $quizzes_id
 * @property integer $question_id
 */
class QuestionQuizzes extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_quizzes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'quizzes_id',
        'question_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'quizzes_id' => 'integer',
        'question_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'quizzes_id' => 'required|integer',
        'question_id' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
