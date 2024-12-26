<?php

namespace App\Http\Controllers;
use App\Models\Message;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('teacher')->get();
        return view('student.dashboard', compact('messages'));
    }
    public function dashboard()
    {
        // Get messages that belong to teachers (could be customized based on relationships)
        $messages = Message::with('teacher')->get();

        return view('student.dashboard', compact('messages'));
    }


}
