<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory;

    
    protected $fillable =[
        'name',
        'state_id'
    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

      
    public function supervisorslga()
    {
        return $this->belongsToMany(User::class,'supervisor_lga','local_government_id','user_id');
        
    }
}
