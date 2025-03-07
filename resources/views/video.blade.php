@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-6">
    <!-- Video Player -->
    <div class="w-full md:w-2/3">
        <video controls class="w-full rounded-lg border-2 border-primary">
            <source src="{{ asset('videos/sample.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="mt-4 text-2xl font-semibold text-primary">Sample Video Title</h2>
        <p class="text-gray-400 text-sm">10k views • 2 days ago</p>

        <!-- Subscribe Button -->
        <div class="mt-4 flex items-center">
            <span class="text-white font-semibold text-lg mr-3">Video Creator</span>
            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-400">Subscribe</button>
        </div>

        <!-- Like & Dislike Buttons -->
        <div class="mt-4 flex items-center space-x-4">
            <button id="like-btn" class="flex items-center text-gray-400 hover:text-primary" onclick="toggleLike()">
                👍 <span id="like-count" class="ml-1">100</span>
            </button>
            <button id="dislike-btn" class="flex items-center text-gray-400 hover:text-primary" onclick="toggleDislike()">
                👎 <span id="dislike-count" class="ml-1">5</span>
            </button>
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

<!-- JavaScript for Like & Dislike -->
<script>
    let liked = false;
    let disliked = false;
    let likeCount = 100;
    let dislikeCount = 5;

    function toggleLike() {
        if (!liked) {
            likeCount++;
            document.getElementById("like-btn").classList.add("text-primary");
            liked = true;

            if (disliked) {
                dislikeCount--;
                document.getElementById("dislike-btn").classList.remove("text-primary");
                disliked = false;
            }
        } else {
            likeCount--;
            document.getElementById("like-btn").classList.remove("text-primary");
            liked = false;
        }
        document.getElementById("like-count").textContent = likeCount;
        document.getElementById("dislike-count").textContent = dislikeCount;
    }

    function toggleDislike() {
        if (!disliked) {
            dislikeCount++;
            document.getElementById("dislike-btn").classList.add("text-primary");
            disliked = true;

            if (liked) {
                likeCount--;
                document.getElementById("like-btn").classList.remove("text-primary");
                liked = false;
            }
        } else {
            dislikeCount--;
            document.getElementById("dislike-btn").classList.remove("text-primary");
            disliked = false;
        }
        document.getElementById("like-count").textContent = likeCount;
        document.getElementById("dislike-count").textContent = dislikeCount;
    }
</script>
@endsection