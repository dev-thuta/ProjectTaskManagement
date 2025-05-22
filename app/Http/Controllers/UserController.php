<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::with('role', 'state', 'town')->paginate(7);
        return view('users.index', [
            'users' => $data,
        ]);
    }

    public function add()
    {
        $roledata = Role::all();
        $statedata = State::all();
        $towndata = Town::all();
        return view('users.add', [
            'roles' => $roledata,
            'states' => $statedata,
            'towns' => $towndata,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
            'phone' => ['required', 'numeric'],
            'state_id' => ['required'],
            'town_id' => ['required'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (request()->hasFile('profile')) {
            $imagePath = request()->file('profile')->store('profiles', 'public');
        }

        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->role_id = request()->role_id;
        $user->phone = request()->phone;
        $user->state_id = request()->state_id;
        $user->town_id = request()->town_id;
        $user->profile = $imagePath;
        $user->save();

        return redirect('/users')->with('success', 'User created successfully.');
    }
}
