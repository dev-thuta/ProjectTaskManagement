<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTo extends Model
{
    use HasFactory;

    public function task() 
    {
        return $this->belongsTo(Task::class);
    }

    public function teamMember() 
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id');
    }

    
}
