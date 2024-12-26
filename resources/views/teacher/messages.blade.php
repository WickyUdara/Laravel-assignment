@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Send Message to Student</h2>
        <form action="{{ route('sendMessage') }}" method="POST">
            @csrf
            <textarea name="content" rows="4" class="form-control" placeholder="Type your message..." required></textarea>
            <input type="text" name="student_id" class="form-control mt-2" placeholder="Enter Student ID" required>
            <button type="submit" class="btn btn-primary mt-2">Send Message</button>
        </form>

        <h3 class="mt-4">Previous Messages</h3>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->student->name }}</td>
                        <td>{{ $message->content }}</td>
                        <td>
                            <form action="{{ route('deleteMessage', $message->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
