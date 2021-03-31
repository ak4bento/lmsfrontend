<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subject
 * @package App\Models
 * @version March 31, 2021, 6:38 am UTC
 *
 * @property string $slug
 * @property string $code
 * @property string $title
 * @property string $description
 * @property integer $default_category_id
 * @property integer $created_by
 */
class Subject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'subjects';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'slug',
        'code',
        'title',
        'description',
        'default_category_id',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'code' => 'string',
        'title' => 'string',
        'description' => 'string',
        'default_category_id' => 'integer',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'slug' => 'required|string|max:191',
        'code' => 'required|string|max:191',
        'title' => 'required|string|max:191',
        'description' => 'required|string',
        'default_category_id' => 'nullable|integer',
        'created_by' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
