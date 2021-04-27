<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionChoiceItem
 * @package App\Models
 * @version April 8, 2021, 2:33 am UTC
 *
 * @property integer $question_id
 * @property string $choice_text
 * @property boolean $is_correct
 */
class QuestionChoiceItem extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_choice_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'question_id',
        'choice_text',
        'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question','question_id','id');
    } 

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer',
        'choice_text' => 'string',
        'is_correct' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question_id' => 'required|integer',
        'choice_text' => 'required|string|max:191',
        'is_correct' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
