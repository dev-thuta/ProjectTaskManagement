<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

$messages = Message::with('sender', 'receiver')
    ->where('sender_id', $userId)
    ->orWhere('receiver_id', $userId)
    ->orderByDesc('created_at')
    ->paginate(10);

        return view('messages.index', compact('messages'));
    }

    public function add()
    {
        $users = User::where('id', '!=', auth()->id())
             ->orderBy('name')
             ->get();

        return view('messages.add', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect('/messages')->with('success', 'Message sent.');
    }

public function edit($id)
{
    $message = Message::findOrFail($id);

    if ($message->sender_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $users = User::where('id', '!=', auth()->id())->orderBy('name')->get();

    return view('messages.edit', compact('message', 'users'));
}


public function update(Request $request, $id)
{
    $message = Message::findOrFail($id);

    if ($message->sender_id !== auth()->id()) {
        return redirect('/messages')->with('error', 'Unauthorized access.');
    }

    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string|max:1000',
    ]);

    $message->update([
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return redirect('/messages')->with('success', 'Message updated successfully.');
}


    public function delete($id)
    {
        $message = Message::findOrFail($id);
        if ($message->sender_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
        $message->delete();

        return redirect('/messages')->with('success', 'Message deleted.');
    }
}

