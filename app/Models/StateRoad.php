<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateRoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district',
        'state_id'
    ];
}
