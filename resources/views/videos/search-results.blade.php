<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
    @forelse($videos as $video)
        <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden shadow-md">
            <a href="{{ route('video.show', $video->VidID) }}">
                <img src="{{ asset($video->thumbnail ?? 'images/default-thumbnail.jpg') }}"
                     alt="Thumbnail" class="w-full h-40 sm:h-48 md:h-56 object-cover">
            </a>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white truncate">
                    <a href="{{ route('video.show', $video->VidID) }}">{{ $video->title }}</a>
                </h3>
                <p class="text-gray-400 text-sm truncate">{{ $video->description }}</p>
                <span class="text-gray-500 text-xs">Views: {{ number_format($video->view_count) }}</span>
            </div>
        </div>
    @empty
        <p class="text-white">No videos found.</p>
    @endforelse
</div>
