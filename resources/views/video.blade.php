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

        

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-primary">Comments</h3>

        @auth
        <form action="{{ route('comment.store', $video->VidID) }}" method="POST" class="mt-3">
            @csrf
            <textarea name="comment_text" class="w-full p-2 rounded bg-gray-800 text-white border border-primary" rows="3" placeholder="Write a comment..." required></textarea>

            <div class="flex items-center mt-2">
                <span class="mr-2 text-white">Rating:</span>
                <div class="flex space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required>
                        <label for="rating-{{ $i }}" class="text-gray-400 hover:text-yellow-400 text-2xl cursor-pointer">★</label>
                    @endfor
                </div>
            </div>

            <button type="submit" class="mt-2 bg-primary text-white px-4 py-2 rounded hover:bg-blue-400">Post Comment</button>
        </form>
        @else
        <p class="mt-3 text-gray-400">Please <a href="{{ route('login') }}" class="text-primary hover:underline">login</a> to leave a comment.</p>
        @endauth

    <!-- Comments List -->
    <div class="mt-4 space-y-4" id="comments-container">
    @foreach($video->comments as $comment)
    <div class="bg-gray-900 p-3 rounded">
        <div class="flex items-start gap-3">
            
            <!-- User pfp -->
            <div class="flex-shrink-0">
            <img src="{{ asset($comment->user->profile_picture ?? 'images/default-profile.png') }}"  
                     alt="{{ $comment->user->name }}" 
                     class="w-10 h-10 rounded-full border border-primary">
            </div>
            
            <!-- Comment Content -->
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-white">{{ $comment->user->username }}</span>
                    <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                
                <!-- Rating Stars -->
                <div class="flex mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-400' }}">★</span>
                    @endfor
                </div>
                
                <!-- Comment Text -->
                <p class="text-gray-300 mt-1">{{ $comment->comment_text }}</p>
            </div>
        </div>
    </div>
    @endforeach
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
    document.querySelectorAll('[name="rating"]').forEach((radio, index) => {
    radio.addEventListener('change', () => {
        document.querySelectorAll('[for^="rating-"]').forEach((star, i) => {
            if (i <= index) {
                star.classList.add('text-yellow-400');
                star.classList.remove('text-gray-400');
            } else {
                star.classList.add('text-gray-400');
                star.classList.remove('text-yellow-400');
            }
        });
    });
});
</script>


<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const player = new Plyr('#player');
    });
</script>

@endsection