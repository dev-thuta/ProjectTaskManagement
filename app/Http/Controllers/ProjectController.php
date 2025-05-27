<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $data = Project::with('user', 'client')->orderBy('name', 'asc')->paginate(7);
        return view('projects.index', [
            'projects' => $data,
        ]);
    }

    public function add()
    {
        $clientdata = Client::where('created_by', auth()->id())->get();
        return view('projects.add', [
            'clients' => $clientdata,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'string'],
            'client_id' => ['required'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = new Project;
        $project->name = request()->name;
        $project->description = request()->description;
        $project->start_date = request()->start_date;
        $project->end_date = request()->end_date;
        $project->client_id = request()->client_id;
        $project->status = request()->status;
        $project->created_by = auth()->id();
        $project->client_id = request()->client_id;
        $project->save();

        return redirect('/projects')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $data = Project::findOrFail($id);
        $clientdata = Client::where('created_by', auth()->id())->get();

        return view('projects.edit', [
            'project' => $data,
            'clients'=> $clientdata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:clients,name,' . $id],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'string'],
            'client_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->client_id = $request->client_id;
        $project->status = $request->status;
        $project->client_id = $request->client_id;
        $project->save();

        return redirect('/projects')->with('success', 'Project updated successfully.');
    }

    public function delete($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('/projects')->with('success', 'Project deleted successfully.');
    }
}
