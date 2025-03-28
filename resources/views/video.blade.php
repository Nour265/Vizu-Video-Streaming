@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

<div class="flex flex-col md:flex-row gap-6">
    <!-- Video Player -->
    <div class="w-full md:w-2/3">
        <video controls class="w-full rounded-lg border-2 border-primary" id="player">
            <source src="{{ asset('videos/' . $video->video_path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="mt-4 text-2xl font-semibold text-primary">{{ $video->title }}</h2>
        <p class="text-gray-400 text-sm">{{ number_format($video->view_count) }} views • {{ $video->created_at->diffForHumans() }}</p>

        <!-- Subscribe Button -->
        <div class="mt-4 flex items-center">
            <span class="text-white font-semibold text-lg mr-3">Video Creator</span>
            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-400">Subscribe</button>
        </div>

        <!-- Star Rating System -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-primary">Rate this video:</h3>
            <div class="flex space-x-1 mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button id="star-{{ $i }}" class="text-gray-400 hover:text-yellow-400 text-2xl" 
                        onmouseover="highlightStars({{ $i }})" 
                        onmouseout="resetStars()" 
                        onclick="rateVideo({{ $i }})">★
                    </button>
                @endfor
            </div>
        </div>

        <!-- Comment Section -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-primary">Comments</h3>
            <form class="mt-3">
                <textarea class="w-full p-2 rounded bg-gray-800 text-white border border-primary" rows="3" placeholder="Write a comment..."></textarea>
                <button type="submit" class="mt-2 bg-primary text-white px-4 py-2 rounded hover:bg-blue-400">Post Comment</button>
            </form>

            <!-- Sample Comments -->
            <div class="mt-4 space-y-4">
                <div class="bg-gray-900 p-3 rounded">
                    <span class="font-semibold text-white">User1</span>
                    <p class="text-gray-400">Great video!</p>
                </div>
                <div class="bg-gray-900 p-3 rounded">
                    <span class="font-semibold text-white">User2</span>
                    <p class="text-gray-400">Loved the content!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Videos -->
    <div class="w-full md:w-1/3">
        <h3 class="text-lg font-semibold mb-4 text-primary">Recommended</h3>
        @foreach([1, 2, 3, 4, 5] as $id)
            <a href="{{ route('video.show', $id) }}" class="flex items-center gap-3 mb-4">
                <img src="https://via.placeholder.com/120x70" alt="Thumbnail" class="rounded-lg w-24 h-14 object-cover border-2 border-primary">
                <div>
                    <h4 class="text-sm font-semibold text-white">Sample Video {{ $id }}</h4>
                    <p class="text-gray-400 text-xs">5k views • 1 day ago</p>
                </div>
            </a>
        @endforeach
    </div>
</div>

<!-- JavaScript for Rating -->
<script>
    let rating = 0;

function highlightStars(star) {
    for (let i = 1; i <= star; i++) {
        document.getElementById("star-" + i).classList.add("text-yellow-400");
    }
}

function resetStars() {
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            document.getElementById("star-" + i).classList.add("text-yellow-400");
        } else {
            document.getElementById("star-" + i).classList.remove("text-yellow-400");
        }
    }
}

function rateVideo(star) {
    rating = star;
}
</script>


<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const player = new Plyr('#player');
    });
</script>

@endsection