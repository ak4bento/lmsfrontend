<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TeachableUser
 * @package App\Models
 * @version April 19, 2021, 1:07 am UTC
 *
 * @property integer $classroom_user_id
 * @property integer $teachable_id
 * @property string|\Carbon\Carbon $completed_at
 */
class TeachableUser extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'teachable_users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'classroom_user_id',
        'teachable_id',
        'completed_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'classroom_user_id' => 'integer',
        'teachable_id' => 'integer',
        'completed_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'classroom_user_id' => 'required|integer',
        'teachable_id' => 'required|integer',
        'completed_at' => 'nullable',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
