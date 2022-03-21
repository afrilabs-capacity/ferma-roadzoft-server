<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    /**
     * Get user projects.
     */
    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class, 'project_id');
    // }
}
