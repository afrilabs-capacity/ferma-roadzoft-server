<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Hash;
use App\Models\State;
use App\Models\LocalGovernment;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'dob', 'state', 'lga', 'onboarded', 'active', 'can_report'

    ];

    // protected $with = ['roles','reports','projects'];


    protected $with = ['roles', 'projects', 'photos', 'registeredstate'];

    protected $dates = ['deleted_at'];

    protected $appends = ['state_name', 'lga_name'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime', 'active' => 'boolean', 'onboarded' => 'boolean', 'can_report' => 'boolean'];

    public function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Report::class, 'user_id');
    }

    public function projects()
    {
        // dd($this->belongsToMany(Project::class,'projects_users','user_id','project_id'));
        return $this->belongsToMany(Project::class, 'projects_users', 'user_id', 'project_id');
    }

    public function accessLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(accessLog::class, 'user_id');
    }

    public function photos(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Photo::class);
    }

    public function isUserAuthorized()
    {
        if (!auth()
            ->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            return false;
        }

        return true;
    }


    public function supervisorreports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SupervisorReport::class, 'user_id');
    }

    public function supervisorstate()
    {
        return $this->belongsToMany(State::class, 'supervisor_state', 'user_id', 'state_id');
    }

    public function registeredstate()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }

    public function supervisorslga()
    {
        return $this->belongsToMany(LocalGovernment::class, 'supervisor_lga', 'user_id', 'local_government_id');
    }

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
}
