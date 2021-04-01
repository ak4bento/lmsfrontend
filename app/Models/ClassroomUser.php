<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClassroomUser
 * @package App\Models
 * @version April 1, 2021, 12:42 am UTC
 *
 * @property integer $classroom_id
 * @property integer $user_id
 * @property string|\Carbon\Carbon $last_accesed_at
 */
class ClassroomUser extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'classroom_user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'classroom_id',
        'user_id',
        'last_accesed_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'classroom_id' => 'integer',
        'user_id' => 'integer',
        'last_accesed_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'classroom_id' => 'required|integer',
        'user_id' => 'required|integer',
        'last_accesed_at' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
