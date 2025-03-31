@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-20">
    <div class="bg-gray-800 text-white shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold text-primary mb-6">Edit Video</h1>

        <!-- Video Update Form -->
        <form action="{{ route('admin.videos.update', $video->VidID) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" 
                       class="w-full p-2 bg-gray-900 text-white rounded-md" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold">Description</label>
                <textarea name="description" id="description" class="w-full p-2 bg-gray-900 text-white rounded-md" required>{{ old('description', $video->description) }}</textarea>
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="genre" class="block text-sm font-semibold">Genre</label>
                <input type="text" name="genre" id="genre" value="{{ old('genre', $video->genre) }}" 
                       class="w-full p-2 bg-gray-900 text-white rounded-md" required>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                    Update Video
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
