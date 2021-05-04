<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'id',
        'progress_type',
        'progress_id',
        'class_id',
        'count',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Function classroom
     *
     * @return \App\Models\Classroom
     **/
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'class_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function boot()
    {
        parent::boot();
        date_default_timezone_set("Asia/Makassar");
        self::creating(function($model){
            $model->created_at = date("h:i:sa");
            // $model->created_by = auth()->guard('contact')->user()->id;
        });

        self::updating(function($model){
            $model->updated_at = date("h:i:sa");
        });
    }
}
