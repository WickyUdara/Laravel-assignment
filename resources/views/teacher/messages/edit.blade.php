@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Message</h1>
    <form action="{{ route('messages.update', $message->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $message->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $message->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Message</button>
        <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
