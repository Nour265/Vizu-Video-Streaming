@extends('layouts.app')

@section('content')
    <div class="pt-20 px-6 text-white">
        <h2 class="text-3xl font-bold mb-6 text-primary">Search Results for "{{ $query }}"</h2>

        @if($videos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <div class="bg-gray-900 border border-gray-700 rounded-lg overflow-hidden shadow-md">
                        <a href="{{ route('videos.index', $video->VidID) }}">
                            <img src="{{ $video->thumbnail ?? 'https://picsum.photos/400/250?random=' . rand(1, 1000) }}" 
                                 alt="Thumbnail" class="w-full h-40 sm:h-48 md:h-56 object-cover bg-gray-800">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-white truncate">
                                <a href="{{ route('videos.index', $video->VidID) }}" class="hover:text-primary transition">
                                    {{ $video->title }}
                                </a>
                            </h3>
                            <span class="text-gray-500 text-xs">Views: {{ number_format($video->view_count) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-lg text-center">No videos found for "{{ $query }}".</p>
        @endif
    </div>
@endsection

