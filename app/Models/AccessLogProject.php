<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLogProject extends Model
{
    use HasFactory;

    protected $fillable =[
        'action',
        'user_id',
        'description',
        'affected_model_id',
        'access_log_id'
    ];

    protected $with = ['user','AffectedModel'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function AffectedModel()
    {
        return $this->belongsTo(Project::class,'affected_model_id')->withTrashed();
    }
}
