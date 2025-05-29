<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\Project;
use App\Models\AssignTo;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Projects where the user is part of the team
        $projects = Project::whereHas('team.teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('team')->get();

        // Tasks where user is part of the task's team
        $tasks = Task::whereHas('team.teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('team')->get();

        // Upcoming tasks assigned to the user
        $upcomingTasks = $tasks->filter(function ($task) use ($user) {
            return $task->assignTos->contains(function ($assign) use ($user) {
                return $assign->teamMember->user_id === $user->id &&
                    $assign->end_date &&
                    $assign->end_date->isFuture();
            });
        });

        return view('fronts.user.index', compact('projects', 'tasks', 'upcomingTasks'));
    }

    public function show()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('fronts.user.profile', compact('user'));
    }

    public function team()
    {
        $user = auth()->user();

        // Teams where user is a member
        $teams = Team::whereHas('teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('project')->get();

        // Team members for those teams
        $teamMembers = TeamMember::whereHas('team', function ($query) use ($user) {
            $query->whereHas('teamMembers', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->with('team', 'user')->get();

        return view('fronts.user.team', compact('teams', 'teamMembers'));
    }

    public function task()
    {
        $user = auth()->user();

        // Tasks where the user is part of the team
        $tasks = Task::whereHas('team.teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with([
            'team',
            'assignTos.teamMember.user', // Load all assigned users, not just current user
        ])->get();

        // Assignments assigned directly to user
        $assigns = AssignTo::whereHas('teamMember', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['task.team', 'teamMember.user'])->get();

        return view('fronts.user.task', compact('tasks', 'assigns'));
    }

    public function login()
    {
        return view('fronts.user.login');
    }
}
