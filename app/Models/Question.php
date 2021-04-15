<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Question
 * @package App\Models
 * @version April 6, 2021, 2:21 am UTC
 *
 * @property string $question_type
 * @property string $answers
 * @property string $content
 * @property string $scoring_method
 * @property integer $created_by
 */
class Question extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'questions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'question_type',
        'answers',
        'content',
        'scoring_method',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_type' => 'string',
        'answers' => 'string',
        'content' => 'string',
        'scoring_method' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question_type' => 'required|string|max:191',
        'answers' => 'required|string',
        'content' => 'required|string',
        // 'scoring_method' => 'required|string|max:191',
        // 'created_by' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
