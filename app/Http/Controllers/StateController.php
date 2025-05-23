<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StateController extends Controller
{
    public function index()
    {
        $data = State::orderBy('name', 'asc')->paginate(7);
        return view('states.index', [
            'states' => $data
        ]);
    }

    public function add()
    {
        return view('states.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:states,name'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $state = new State;
        $state->name = request()->name;
        $state->save();

        return redirect('/states')->with('success', 'State created successfully.');
    }

    public function edit($id)
    {
        $data = State::findOrFail($id);

        return view('states.edit', [
            'state' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('states', 'name')->ignore($state->id)],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $state->name = $request->name;
        $state->save();

        return redirect('/states')->with('success', 'State updated successfully.');
    }

    public function delete($id)
    {
        $state = State::find($id);
        $state->delete();

        return redirect('/states')->with('success', 'State deleted successfully.');
    }
}
