<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TownController extends Controller
{
    public function index()
    {
        $data = Town::with('state')->orderBy('name', 'asc')->paginate(7);
        return view('towns.index', [
            'towns' => $data
        ]);
    }

    public function add()
    {
        $data = State::all();
        return view('towns.add', [
            'states' => $data
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:towns,name'],
            'state_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $town = new Town;
        $town->name = request()->name;
        $town->state_id = request()->state_id;
        $town->save();

        return redirect('/towns')->with('success', 'Town created successfully.');
    }

    public function edit($id)
    {
        $data = Town::findOrFail($id);
        $statedata = State::all();
        return view('towns.edit', [
            'town' => $data,
            'states' => $statedata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $town = Town::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('towns', 'name')->ignore($town->id)],
            'state_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $town->name = $request->name;
        $town->state_id = $request->state_id;
        $town->save();

        return redirect('/towns')->with('success', 'Town updated successfully.');
    }

    public function delete($id)
    {
        $town = Town::find($id);
        $town->delete();

        return redirect('/towns')->with('success', 'Town deleted successfully.');
    }
}
