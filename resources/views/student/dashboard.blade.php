@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Dashboard</h1>
    <h2>Messages from Teachers</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->content }}</td>
                    <td>{{ $message->teacher->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
