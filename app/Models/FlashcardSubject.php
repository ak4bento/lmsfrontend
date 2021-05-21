<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardSubject
 * @package App\Models
 * @version May 19, 2021, 6:58 am UTC
 *
 * @property string $subject
 * @property string $subject_type
 * @property string $reference
 * @property string $external_link
 */
class FlashcardSubject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_subjects';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'subject',
        'files',
        'subject_type',
        'reference',
        'external_link'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject' => 'string',
        'reference' => 'string',
        'external_link' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
