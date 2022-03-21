<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class AccessLogRoleAssignment extends Model
{
    use HasFactory;
    protected $fillable =[
        'action',
        'user_id',
        'description',
        'affected_role_model_id',
        'affected_user_model_id',
        'access_log_id'
    ];

    protected $with = ['user','AffectedRoleModel','AffectedUserModel'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function AffectedRoleModel()
    {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class,'affected_role_model_id');
    }

    public function AffectedUserModel()
    {
        return $this->belongsTo(User::class,'affected_user_model_id')->withTrashed();
    }
}
