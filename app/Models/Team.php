<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    public function project()
	{
    		return $this->belongsTo(Project::class);
	}

	public function teamMembers()
	{
		return $this->hasMany(TeamMember::class);
	}

}
