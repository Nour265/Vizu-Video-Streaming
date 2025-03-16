@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-primary">Trending Videos</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($videos as $video)
            <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <a href="{{ route('video.show', $video->VidID) }}">
                    <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-48 object-cover">
                </a>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-primary">{{ $video->title }}</h3>
                    <p class="text-gray-400 text-sm">{{ Str::limit($video->description, 80) }}</p>
                    <small class="text-gray-500">Views: {{ $video->view_count }}</small>
                </div>
            </div>
        @endforeach
    </div>
@endsection
