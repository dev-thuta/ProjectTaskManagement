<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\State;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function index()
    {
        $data = Town::with('state')->paginate(7);
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
            'name' => ['required', 'string' ,'max:255'],
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
}
