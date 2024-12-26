<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teacher.dashboard');
    }

    
    public function showStudents()
    {
        $students = User::where('role', 'student')->get();
        return view('teacher.students', compact('students'));
    }

    // Update the student's role
    public function updateRole(Request $request, User $student)
    {
        $request->validate([
            'role' => 'required|in:teacher,student',
        ]);

        // Ensure the teacher cannot change their own role
        if (Auth::id() == $student->id) {
            return back()->withErrors(['role' => 'You cannot change your own role.']);
        }

        $student->role = $request->role;
        $student->save();

        return back()->with('success', 'Student role updated successfully.');
    }

    // Delete the student
    public function deleteStudent(User $student)
    {
        // Ensure the teacher cannot delete themselves
        if (Auth::id() == $student->id) {
            return back()->withErrors(['delete' => 'You cannot delete yourself.']);
        }

        $student->delete();
        return back()->with('success', 'Student deleted successfully.');
    }
}
