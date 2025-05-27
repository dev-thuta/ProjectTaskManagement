<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_member extends Model
{
    use HasFactory;

    public function team()
	{
    		return $this->belongsTo(Team::class);
	}

    public function user()
	{
    		return $this->belongsTo(User::class);
	}
}
