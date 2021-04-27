<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Teachable
 * @package App\Models
 * @version April 6, 2021, 3:10 am UTC
 *
 * @property integer $teachable_id
 * @property string $teachable_type
 * @property integer $classroom_id
 * @property string|\Carbon\Carbon $available_at
 * @property string|\Carbon\Carbon $expires_at
 * @property number $final_grade_weight
 * @property integer $max_attempts_count
 * @property integer $order
 * @property number $pass_threshold
 * @property integer $created_by
 */
class Teachable extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'teachables';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'teachable_id',
        'teachable_type',
        'classroom_id',
        'available_at',
        'expires_at',
        'final_grade_weight',
        'max_attempts_count',
        'order',
        'pass_threshold',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'teachable_id' => 'integer',
        'teachable_type' => 'string',
        'classroom_id' => 'integer',
        'available_at' => 'datetime',
        'expires_at' => 'datetime',
        'final_grade_weight' => 'float',
        'max_attempts_count' => 'integer',
        'order' => 'integer',
        'pass_threshold' => 'float',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'teachable_id' => 'required|integer',
        'teachable_type' => 'required|string|max:191',
        'classroom_id' => 'required|integer',
        'available_at' => 'nullable',
        'expires_at' => 'nullable',
        'final_grade_weight' => 'required|numeric',
        'max_attempts_count' => 'required|integer',
        'order' => 'required|integer',
        'pass_threshold' => 'required|numeric',
        'created_by' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
