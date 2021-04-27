<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Discussion
 * @package App\Models
 * @version April 6, 2021, 1:22 am UTC
 *
 * @property string $title
 * @property string $description
 * @property string $grading_method
 * @property integer $created_by
 */
class Discussion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'discussions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'discussable_type',
        'discussable_id',
        'message',
        'reply_to',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'discussable_type' => 'string',
        'discussable_id' => 'integer',
        'message' => 'string',
        'reply_to' => 'string',
        'user_id' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'discussable_type' => 'required',
        'discussable_id' => 'required',
        'message' => 'required',
    ];


}
