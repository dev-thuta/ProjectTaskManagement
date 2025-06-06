<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Task;
use App\Models\Team;
use App\Models\Town;
use App\Models\User;
use App\Models\State;
use App\Models\Message;
use App\Models\Project;
use App\Models\AssignTo;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FrontUserController extends Controller
{
    // Redirect if not authenticated
    private function redirectIfGuest()
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'Please log in first.');
        }
    }

public function index()
{
    $user = auth()->user();

    $projects = Project::whereHas('team.teamMembers', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->with('team')->get();

    $tasks = Task::whereHas('team.teamMembers', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->with('team')->get();

    $upcomingTasks = $tasks->filter(function ($task) use ($user) {
        return $task->assignTos->contains(function ($assign) use ($user) {
            return $assign->teamMember->user_id === $user->id &&
                $assign->end_date &&
                $assign->end_date->isFuture();
        });
    });

    // Messages received by user, latest 10, with sender relationship eager loaded
    $messages = Message::where('receiver_id', $user->id)
                ->with('sender')
                ->latest()
                ->paginate(10);

    // Other users to send messages to (exclude current user)
    $users = User::where('id', '!=', $user->id)->orderBy('name')->get();

    return view('fronts.user.index', compact('projects', 'tasks', 'upcomingTasks', 'messages', 'users'));
}



    public function show()
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $user = auth()->user();
        return view('fronts.user.profile', compact('user'));
    }

    public function edit($id)
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $roledata = Role::all();
        $statedata = State::all();
        $towndata = Town::all();
        $data = User::findOrFail($id);

        return view('fronts.user.edit_profile', [
            'roles' => $roledata,
            'states' => $statedata,
            'towns' => $towndata,
            'user' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $user = User::findOrFail($id);
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'state_id' => ['required', 'exists:states,id'],
            'town_id' => ['required', 'exists:towns,id'],
            'profile' => ['image', 'mimes:webp,jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $imagePath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->town_id = $request->town_id;

        $user->save();

        return redirect('/front/users/view-profile')->with('success', 'Profile updated successfully.');
    }

    public function updateTask(Request $request, $id)
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $validated = $request->validate([
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        $assign = AssignTo::findOrFail($id);

        if ($assign->teamMember->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $assign->status = $validated['status'];
        $assign->save();

        return back()->with('success', 'Task status updated successfully.');
    }

    public function team()
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $user = auth()->user();

        $teams = Team::whereHas('teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('project')->get();

        $teamMembers = TeamMember::whereHas('team', function ($query) use ($user) {
            $query->whereHas('teamMembers', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->with('team', 'user')->get();

        return view('fronts.user.team', compact('teams', 'teamMembers'));
    }

    public function task()
    {
        if ($redirect = $this->redirectIfGuest()) return $redirect;

        $user = auth()->user();

        $tasks = Task::whereHas('team.teamMembers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with([
            'team',
            'assignTos.teamMember.user',
        ])->get();

        $assigns = AssignTo::whereHas('teamMember', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['task.team', 'teamMember.user'])->get();

        return view('fronts.user.task', compact('tasks', 'assigns'));
    }

    public function login()
    {
        return view('fronts.user.login');
    }

    public function sendMessage(Request $request)
{
    $user = auth()->user();

    $validator = Validator::make($request->all(), [
        'receiver_id' => 'required|exists:users,id|not_in:'.$user->id,
        'message' => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    Message::create([
        'sender_id' => $user->id,
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', 'Message sent successfully!');
}
}
