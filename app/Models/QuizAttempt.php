<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuizAttempt
 * @package App\Models
 * @version April 19, 2021, 1:05 am UTC
 *
 * @property integer $teachable_user_id
 * @property integer $attempt
 * @property string $questions
 * @property string $answers
 * @property string|\Carbon\Carbon $completed_at
 * @property string $grading_method
 */
class QuizAttempt extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'quiz_attempts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'teachable_user_id',
        'attempt',
        'questions',
        'answers',
        'completed_at',
        'grading_method'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'teachable_user_id' => 'integer',
        'attempt' => 'integer',
        'questions' => 'string',
        'answers' => 'string',
        'completed_at' => 'datetime',
        'grading_method' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'teachable_user_id' => 'required|integer',
        'attempt' => 'required|integer',
        'questions' => 'required|string',
        'answers' => 'required|string',
        'completed_at' => 'nullable',
        'grading_method' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
