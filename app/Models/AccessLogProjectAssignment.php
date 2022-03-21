<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLogProjectAssignment extends Model
{
    use HasFactory;
    protected $fillable =[
        'action',
        'user_id',
        'description',
        'affected_project_model_id',
        'affected_user_model_id',
        'access_log_id'
    ];

    protected $with = ['user','AffectedProjectModel','AffectedUserModel'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function AffectedProjectModel()
    {
        return $this->belongsTo(Project::class,'affected_project_model_id');
    }

    public function AffectedUserModel()
    {
        return $this->belongsTo(User::class,'affected_user_model_id')->withTrashed();
    }
}
