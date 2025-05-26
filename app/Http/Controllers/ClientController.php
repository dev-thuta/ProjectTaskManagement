<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $data = Client::with('user')->orderBy('name', 'asc')->paginate(7);
        return view('clients.index', [
            'clients' => $data,
        ]);
    }

    public function add()
    {
        return view('clients.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'profile' => ['nullable', 'image', 'mimes:webp,jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (request()->hasFile('profile')) {
            $imagePath = request()->file('profile')->store('profiles', 'public');
        }

        $client = new Client;
        $client->name = request()->name;
        $client->email = request()->email;
        $client->phone = request()->phone;
        $client->created_by = auth()->id();
        $client->profile = $imagePath;
        $client->save();

        return redirect('/clients')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $data = Client::findOrFail($id);

        return view('clients.edit', [
            'client' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('clients')->ignore($client->id)],
            'phone' => ['required', 'numeric'],
            'profile' => ['nullable', 'image', 'mimes:webp,jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $client->profile = $imagePath;
        }

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();

        return redirect('/clients')->with('success', 'Client updated successfully.');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect('/clients')->with('success', 'Client deleted successfully.');
    }
}
