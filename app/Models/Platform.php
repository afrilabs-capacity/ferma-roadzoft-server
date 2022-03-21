<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description'
    ];


    protected $dates = ['deleted_at'];

    /**
     * Get all users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'platform_user', 'platform_id', 'user_id');
    }
}
