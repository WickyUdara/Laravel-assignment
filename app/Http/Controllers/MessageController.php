<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show the form and list messages
    public function index()
    {
        $messages = Message::where('teacher_id', Auth::id())->get();
        return view('teacher.dashboard', compact('messages'));
    }
    public function edit($id)
{
    $message = Message::findOrFail($id);

    // Check if the logged-in teacher owns the message
    if ($message->teacher_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('teacher.messages.edit', compact('message'));
}
    // Add a new message
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', 'Message added successfully.');
    }

    // Edit a message
    public function update(Request $request, $id)
{
    $message = Message::findOrFail($id);

    // Check if the logged-in teacher owns the message
    if ($message->teacher_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $message->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('teacher.dashboard')->with('success', 'Message updated successfully!');
}


    // Delete a message
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('teacher.dashboard')->with('success', 'Message deleted successfully.');
    }
}
