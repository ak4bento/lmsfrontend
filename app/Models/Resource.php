<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Resource
 * @package App\Models
 * @version April 13, 2021, 2:36 am UTC
 *
 * @property string $type
 * @property string $title
 * @property string $data
 * @property string $description
 * @property integer $created_by
 */
class Resource extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'resources';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'title',
        'data',
        'description',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'title' => 'string',
        'data' => 'string',
        'description' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|string',
        'title' => 'required|string',
        'data' => 'required|string',
        'description' => 'required|string',
        'created_by' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
