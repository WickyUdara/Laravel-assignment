<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [MessageController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/students', [TeacherController::class, 'showStudents'])->name('teacher.students');
    Route::post('/teacher/students/{student}/update-role', [TeacherController::class, 'updateRole'])->name('teacher.students.updateRole');
    Route::delete('/teacher/students/{student}', [TeacherController::class, 'deleteStudent'])->name('teacher.students.delete');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('messages.edit');

    Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/messages', [MessageController::class, 'studentMessages'])->name('studentMessages');

});
require __DIR__.'/auth.php';
