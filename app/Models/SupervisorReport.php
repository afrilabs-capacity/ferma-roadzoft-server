<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class SupervisorReport extends Model
{
    use HasFactory;

    protected $appends  =  ['state_name', 'lga_name'];

    protected $fillable =  [
        'uuid',
        'user_id',
        'nos',
        'submitted',
        'geo_zone',
        'state',
        'lga',
        'rsc',
        'sos',
        'location',
        'nfsos',
        'nwos',
        'now',
        'rating',
        'npw',
        'gtw',
        'eqw',
        'wgatm',
        'envsor',
        'or',
        'status'
    ];


    protected $casts = [
        'sos' => 'boolean',
        'gtw' => 'boolean',
        'eqw' => 'boolean',
    ];

    public function getStateNameAttribute()
    {
        $state = State::find($this->state);
        return  isset($state->id) ?  $state->name : 'N\A';
    }

    public function getLGANameAttribute()
    {
        $lga = LocalGovernment::find($this->lga);
        return  isset($lga->id) ?  $lga->name : 'N\A';
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
