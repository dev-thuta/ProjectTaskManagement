<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $data = State::latest()->paginate(7);
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
            'name' => ['required', 'string' ,'max:255'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $state = new State;
        $state->name = request()->name;
        $state->save();

        return redirect('/states')->with('success', 'State created successfully.');
    }
}
