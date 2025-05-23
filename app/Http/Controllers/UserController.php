<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $data = User::with('role', 'state', 'town')->orderBy('name', 'asc')->paginate(7);
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
            'profile' => ['nullable', 'image', 'mimes:webp,jpeg,png,jpg,gif', 'max:2048'],
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

    public function edit($id)
    {
        $roledata = Role::all();
        $statedata = State::all();
        $towndata = Town::all();
        $data = User::findOrFail($id);

        return view('users.edit', [
            'roles' => $roledata,
            'states' => $statedata,
            'towns' => $towndata,
            'user' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['required', 'numeric'],
            'state_id' => ['required', 'exists:states,id'],
            'town_id' => ['required', 'exists:towns,id'],
            'profile' => ['nullable', 'image', 'mimes:webp,jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $imagePath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->role_id = $request->role_id;
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->town_id = $request->town_id;

        $user->save();

        return redirect('/users')->with('success', 'User updated successfully.');
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully.');
    }
}
