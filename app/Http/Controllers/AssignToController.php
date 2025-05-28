<?php

namespace App\Http\Controllers;

use App\Models\AssignTo;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssignToController extends Controller
{
    public function index()
    {
        $data = AssignTo::with(['task', 'teamMember.user'])->paginate(7);
        return view('assigns.index', [
            'assigns' => $data,
        ]);
    }

    public function add($id)
    {
        $task = Task::with('team.teamMembers.user')->findOrFail($id);

        $teammembers = $task->team ? $task->team->teamMembers : collect();

        return view('assigns.add', compact('task', 'teammembers'));
    }

    public function create(Request $request)
    {
        $validator = validator(request()->all(), [
            'task_id' => ['required'],
            'team_member_id' => [
                'required',
                Rule::unique('assign_tos')->where(function ($query) use ($request) {
                    return $query->where('task_id', $request->task_id);
                })
            ],
            'status' => ['required', 'string'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $assigns = new AssignTo();$assigns->task_id = request()->task_id;
        $assigns->team_member_id = request()->team_member_id;
        $assigns->status = request()->status;
        $assigns->start_date = request()->start_date;
        $assigns->end_date = request()->end_date;
        $assigns->save();

        return redirect('/tasks')->with('success', 'Task assigned successfully.');
    }

    public function edit($id)
    {
        $assign = AssignTo::with('task.team.teamMembers.user')->findOrFail($id);
        $teammembers = $assign->task->team ? $assign->task->team->teamMembers : collect();
        return view('assigns.edit', compact('assign', 'teammembers'));
    }

    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'task_id' => ['required'],
            'team_member_id' => [
                'required',
                Rule::unique('assign_tos')->where(function ($query) use ($request, $id) {
                    return $query->where('task_id', $request->task_id)
                                ->where('id', '!=', $id);
                }),
            ],
            'status' => ['required', 'string'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $assign = AssignTo::findOrFail($id);
        $assign->task_id = $request->task_id;
        $assign->team_member_id = $request->team_member_id;
        $assign->status = $request->status;
        $assign->start_date = $request->start_date;
        $assign->end_date = $request->end_date;
        $assign->save();

        return redirect('/assigns')->with('success', 'Assigned Member updated successfully.');
    }

    public function delete($id)
    {
        $assign = AssignTo::find($id);
        $assign->delete();

        return redirect('/assigns')->with('success', 'Assigned Member deleted successfully.');
    }
}
