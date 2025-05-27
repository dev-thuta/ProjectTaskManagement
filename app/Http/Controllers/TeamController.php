<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index()
    {
        $data = Team::with('project')->orderBy('name', 'asc')->paginate(7);
        return view('teams.index', [
            'teams' => $data
        ]);
    }

    public function add()
    {
        $projectdata = Project::where('created_by', auth()->id())->get();
        return view('teams.add', [
            'projects' => $projectdata,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => [
                 'required',
                'string',
                'max:255',
                Rule::unique('teams')->where(function ($query) {
                    return $query->where('project_id', request()->project_id);
                }),
            ],
            'project_id' => ['required'],
            'description' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $team = new Team;
        $team->name = request()->name;
        $team->project_id = request()->project_id;
        $team->description = request()->description;
        $team->save();

        return redirect('/teams')->with('success', 'Team created successfully.');
    }

    public function edit($id)
    {
        $data = Team::findOrFail($id);
        $projectdata = Project::where('created_by', auth()->id())->get();

        return view('teams.edit', [
            'team' => $data,
            'projects'=> $projectdata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams')
                    ->where(fn($query) => $query->where('project_id', request()->project_id))
                    ->ignore($id),
            ],
            'project_id' => ['required'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $team->name = $request->name;
        $team->project_id = $request->project_id;
        $team->description = $request->description;
        $team->save();

        return redirect('/teams')->with('success', 'Team updated successfully.');
    }

    public function delete($id)
    {
        $team = Team::find($id);
        $team->delete();

        return redirect('/teams')->with('success', 'Team deleted successfully.');
    }
}
