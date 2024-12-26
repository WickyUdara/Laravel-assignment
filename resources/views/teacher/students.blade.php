@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0">Students List</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <a href="{{ route('teacher.dashboard') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-users"></i> Go back
                        </a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                <form action="{{ route('teacher.students.updateRole', $student) }}" method="POST">
                                                    @csrf
                                                    <select name="role" onchange="this.form.submit()" class="form-control form-control-sm">
                                                        <option value="student" {{ $student->role === 'student' ? 'selected' : '' }}>Student</option>
                                                        <option value="teacher" {{ $student->role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('teacher.students.delete', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
