<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::latest()->paginate(7);
        return view('roles.index', [
            'roles' => $data
        ]);
    }

    public function add()
    {
        return view('roles.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string' ,'max:255'],
            'description' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = new Role;
        $role->name = request()->name;
        $role->description = request()->description;
        $role->save();

        return redirect('/roles')->with('success', 'Role created successfully.');
    }
}
