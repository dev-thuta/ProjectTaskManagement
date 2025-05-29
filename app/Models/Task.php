<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Project;
use App\Models\AssignTo;
use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class, 'assign_tos', 'task_id', 'team_member_id');
    }

    public function assignTos()
    {
        return $this->hasMany(AssignTo::class, 'task_id');
    }
}
