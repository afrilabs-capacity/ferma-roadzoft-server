<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class State extends Model
{
    use HasFactory;

    protected $with = ['stateroads'];

    protected $fillable = [
        'name'
    ];

    public function localgovernments()
    {
        return $this->hasMany(LocalGovernment::class);
    }

    public function supervisorstate()
    {
        return $this->belongsToMany(User::class, 'supervisor_state', 'state_id', 'user_id');
    }

    public function stateroads()
    {
        return $this->hasMany(StateRoad::class);
    }
}
