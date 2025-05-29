<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTo extends Model
{
    use HasFactory;
    protected $casts = [
        'end_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function teamMember() 
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id');
    }

    
}
