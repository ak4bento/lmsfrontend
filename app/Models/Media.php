<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Media
 * @package App\Models
 * @version April 6, 2021, 1:22 am UTC
 *
 * @property string $title
 * @property string $description
 * @property string $grading_method
 * @property integer $created_by
 */
class Media extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'media';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'media_type',
        'media_id',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'manipulations',
        'custom_properties',
        'responsive_images',
        'order_column',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'media_type' => 'string',
        'media_id' => 'integer',
        'collection_name' => 'string',
        'name' => 'string',
        'file_name' => 'string',
        'mime_type' => 'string',
        'disk' => 'string',
        'size' => 'integer',
        'manipulations' => 'string',
        'custom_properties' => 'string',
        'responsive_images' => 'string',
        'order_column' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'media_type' => 'required',
        'media_id' => 'required',
        'file' => 'max:2000',
    ];


}
