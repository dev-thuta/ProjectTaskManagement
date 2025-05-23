<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::orderBy('name', 'asc')->paginate(7);
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
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
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
    
    public function edit($id)
    {
        $data = Role::findOrFail($id);

        return view('roles.edit', [
            'role' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'description' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return redirect('/roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $user = Role::find($id);
        $user->delete();

        return redirect('/roles')->with('success', 'Role deleted successfully.');
    }
}
