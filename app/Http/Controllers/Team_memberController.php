<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Team_member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Team_memberController extends Controller
{
    public function index()
    {
        $data = Team_member::with('team', 'user')->orderBy('team_id', 'asc')->paginate(7);
        return view('team_members.index', [
            'teammembers' => $data
        ]);
    }

    public function add()
    {
        $userdata = User::where('role_id', 2)->get();
        $teamdata = Team::whereIn('project_id', function($query) {
            $query->select('id')
                ->from('projects')
                ->where('created_by', auth()->id());
        })->get();
        return view('team_members.add', [
            'users' => $userdata,
            'teams' => $teamdata,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'team_id' => ['required'],
            'user_id' => [
                'required',
                Rule::unique('team_members')->where(function ($query) {
                    return $query->where('team_id', request()->team_id);
                }),
            ],
            'role' => ['required'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $team_member = new Team_member();
        $team_member->team_id = request()->team_id;
        $team_member->user_id = request()->user_id;
        $team_member->role = request()->role;
        $team_member->save();

        return redirect('/team-members')->with('success', 'Team Member created successfully.');
    }

    public function edit($id)
    {
        $data = Team_member::findOrFail($id);
        $userdata = User::where('role_id', 2)->get();
        $teamdata = Team::whereIn('project_id', function($query) {
            $query->select('id')
                ->from('projects')
                ->where('created_by', auth()->id());
        })->get();

        return view('team_members.edit', [
            'teammember' => $data,
            'teams' => $teamdata,
            'users' => $userdata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $teammember = Team_member::findOrFail($id);
        $validator = validator(request()->all(), [
            'team_id' => ['required'],
            'user_id' => [
                'required',
                Rule::unique('team_members')->where(function ($query) use ($request) {
                    return $query->where('team_id', $request->team_id);
                })->ignore($id),
            ],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $teammember->team_id = $request->team_id;
        $teammember->user_id = $request->user_id;
        $teammember->role = $request->role;
        $teammember->save();

        return redirect('/team-members')->with('success', 'Team Member updated successfully.');
    }

    public function delete($id)
    {
        $teammember = Team_member::find($id);
        $teammember->delete();

        return redirect('/team-members')->with('success', 'Team Member deleted successfully.');
    }
}
