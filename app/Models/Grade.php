<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Grade
 * @package App\Models
 * @version April 29, 2021, 1:37 am UTC
 *
 * @property integer $gradeable_id
 * @property string $gradeable_type
 * @property string $grading_method
 * @property string $comments
 * @property number $grade
 * @property string|\Carbon\Carbon $completed_at
 * @property integer $graded_by
 */
class Grade extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'grades';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'gradeable_id',
        'gradeable_type',
        'grading_method',
        'comments',
        'grade',
        'completed_at',
        'graded_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gradeable_id' => 'integer',
        'gradeable_type' => 'string',
        'grading_method' => 'string',
        'comments' => 'string',
        'grade' => 'float',
        'completed_at' => 'datetime',
        'graded_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'gradeable_id' => 'required|integer',
        'gradeable_type' => 'required|string|max:191',
        'grading_method' => 'required|string|max:191',
        'comments' => 'required|string',
        'grade' => 'required|numeric',
        'completed_at' => 'nullable',
        'graded_by' => 'nullable|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
