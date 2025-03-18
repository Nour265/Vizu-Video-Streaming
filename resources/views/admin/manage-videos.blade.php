@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Videos</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Uploaded By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
            <tr>
                <td>{{ $video->id }}</td>
                <td>{{ $video->title }}</td>
                <td>{{ $video->user->name }}</td> <!-- Assuming your Video model has a user relation -->
                <td>
                    <a href="{{ route('videos.show', $video->id) }}" class="btn btn-info">View</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
