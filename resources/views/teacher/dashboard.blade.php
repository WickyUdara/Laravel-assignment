@extends('layouts.app')

@section('content')

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0">Welcome, Teacher</h1>
                    </div>
                    <div class="card-body">
                        <p class="lead">Manage your students efficiently through the dashboard.</p>
                        <a href="{{ route('teacher.students') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-users"></i> View All Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h2>Add a Message</h2>
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Message</button>
    </form>

    <!-- Display Messages -->
    <h2 class="mt-5">Your Messages</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->content }}</td>
                    <td>
                        <!-- Edit Message -->
                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning">Edit</a>                        <!-- Delete Message -->
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $message->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('messages.update', $message->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $message->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea name="content" class="form-control" rows="4" required>{{ $message->content }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
