<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Classroom
 * @package App\Models
 * @version March 31, 2021, 6:41 am UTC
 *
 * @property integer $subject_id
 * @property integer $teaching_period_id
 * @property string $slug
 * @property string $code
 * @property string $title
 * @property string $description
 * @property time $start_at
 * @property time $end_at
 * @property integer $created_by
 */
class Classroom extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'classrooms';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'subject_id',
        'teaching_period_id',
        'slug',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject_id' => 'integer',
        'teaching_period_id' => 'integer',
        'slug' => 'string',
        'code' => 'string',
        'title' => 'string',
        'description' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject_id' => 'required|integer',
        'teaching_period_id' => 'required|integer',
        // 'slug' => 'required|string|max:191',
        'code' => 'required|string|max:50',
        'title' => 'required|string|max:191',
        'description' => 'required|string',
        'start_at' => 'required',
        'end_at' => 'required|after:start_at',
        // 'created_by' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
