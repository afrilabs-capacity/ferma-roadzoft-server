<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'description',
    ];

    protected $with = ['user'];
     
    /**
     * Get all users.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');  
    }
}
