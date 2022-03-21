<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLogRole extends Model
{
    use HasFactory;
    protected $fillable =[
        'action',
        'user_id',
        'description',
        'affected_model_id',
        'access_log_id'
    ];
}
