@extends('layouts.app')

@section('content')
    <div class="pt-20 px-6">
        <h2 class="text-3xl font-bold mb-6 text-primary">Trending Videos</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($videos as $video)
                <div class="bg-cardBg border border-gray-600 rounded-lg overflow-hidden shadow-md">
                    <!-- Video Thumbnail -->
                    <a href="{{ route('videos.index', $video->VidID) }}">
                        <img src="{{ asset($video->thumbnail ?? 'images/default-thumbnail.jpg') }}" 
                            alt="Thumbnail" class="w-full h-40 sm:h-48 md:h-56 object-cover bg-gray-800">
                    </a>

                    <!-- Video Details -->
                    <div class="p-4">
                        <!-- ✅ Video Title Changes Color Dynamically -->
                        <h3 class="text-lg font-semibold transition-colors duration-500 video-title">
                            <a href="{{ route('videos.index', $video->VidID) }}">{{ $video->title }}</a>
                        </h3>

                        <p class="text-gray-400 text-sm truncate">{{ $video->description }}</p>
                        <span class="text-gray-500 text-xs">Views: {{ number_format($video->view_count) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
