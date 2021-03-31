<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TeachingPeriod
 * @package App\Models
 * @version March 31, 2021, 6:40 am UTC
 *
 * @property string $name
 * @property string $start_at
 * @property string $end_at
 */
class TeachingPeriod extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'teaching_periods';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'start_at',
        'end_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'start_at' => 'date',
        'end_at' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:191',
        'start_at' => 'required',
        'end_at' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
