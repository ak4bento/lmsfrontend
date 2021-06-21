<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardAnswer
 * @package App\Models
 * @version June 21, 2021, 6:03 am UTC
 *
 * @property integer $user_id
 * @property integer $flashcard_questions_id
 * @property string $group
 * @property string $choice
 */
class FlashcardAnswer extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_answers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'flashcard_questions_id',
        'group',
        'choice'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'flashcard_questions_id' => 'integer',
        'group' => 'string',
        'choice' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'flashcard_questions_id' => 'required|integer',
        'group' => 'required|string|max:191',
        'choice' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
