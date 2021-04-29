<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ModelHasRole
 * @package App\Models
 * @version April 29, 2021, 6:10 am UTC
 *
 * @property \App\Models\Role $role
 * @property string $model_type
 * @property integer $model_id
 */
class ModelHasRole extends Model
{
  
    use HasFactory;

    public $table = 'model_has_roles';
    
    public $timestamps = false;



    public $fillable = [
        'model_type',
        'model_id',
        'role_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'role_id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'model_type' => 'required|string|max:191',
        'model_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }
}
