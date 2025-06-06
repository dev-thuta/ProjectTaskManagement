<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::with(['project', 'team', 'teamMembers.user'])
            ->whereHas('team.project', function ($query) {
                $query->where('created_by', auth()->id());
            })
            ->paginate(7);

        return view('tasks.index', [
            'tasks' => $data,
        ]);
    }

    public function add()
    {
        $projectdata = Project::where('created_by', auth()->id())->get();
        $teamdata = Team::all();

        return view('tasks.add', [
            'projects' => $projectdata,
            'teams' => $teamdata,
        ]);
    }

    public function create(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks')->where(function ($query) use ($request) {
                    return $query->where('team_id', $request->team_id);
                }),
            ],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string', Rule::in(['high', 'medium', 'low'])],
            'type' => ['required', 'string', Rule::in(['requirement', 'design', 'development', 'testing', 'deployment', 'maintenance'])],
            'project_id' => ['required', 'exists:projects,id'],
            'team_id' => ['required', 'exists:teams,id'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->type = $request->type;  // <-- Added type here
        $task->project_id = $request->project_id;
        $task->team_id = $request->team_id;
        $task->save();

        return redirect('/tasks')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $data = Task::findOrFail($id);
        $projectdata = Project::where('created_by', auth()->id())->get();
        $teamdata = Team::all();

        return view('tasks.edit', [
            'task' => $data,
            'projects'=> $projectdata,
            'teams' => $teamdata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validator = validator($request->all(), [
            'name' => [
                'required',
                'string',
                Rule::unique('tasks')->where(function ($query) use ($request) {
                    return $query->where('team_id', $request->team_id);
                })->ignore($id),
            ],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string', Rule::in(['high', 'medium', 'low'])],
            'type' => ['required', 'string', Rule::in(['requirement', 'design', 'development', 'testing', 'deployment', 'maintenance'])],
            'project_id' => ['required', 'exists:projects,id'],
            'team_id' => ['required', 'exists:teams,id'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->type = $request->type; // <-- Added type here
        $task->project_id = $request->project_id;
        $task->team_id = $request->team_id;
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully.');
    }
}
