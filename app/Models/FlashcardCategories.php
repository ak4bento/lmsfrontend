<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FlashcardCategories
 * @package App\Models
 * @version June 21, 2021, 6:06 am UTC
 *
 * @property integer $parent_id
 * @property string $second_parent_id
 * @property string $third_parent_id
 * @property integer $level
 * @property string $category
 */
class FlashcardCategories extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'flashcard_categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'parent_id',
        'second_parent_id',
        'third_parent_id',
        'level',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'second_parent_id' => 'string',
        'third_parent_id' => 'string',
        'level' => 'integer',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable|integer',
        'second_parent_id' => 'nullable|string',
        'third_parent_id' => 'nullable|string',
        'level' => 'required|integer',
        'category' => 'required|string|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
