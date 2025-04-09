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
    <div class="flex items-center space-x-4">
    <span class="text-lg font-semibold">{{ $name }}</span>
    
    <button id="subscribe-btn" 
            class="px-4 py-2 {{ $isSubscribed ? 'bg-red-500' : 'bg-blue-500' }} text-white rounded-md"
            onclick="toggleSubscription('{{ $channelId }}')">
        {{ $isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
    </button>
    
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
            <img src="{{ asset($comment->user->profile_picture ?? 'images/user-icon.png') }}"  
                     alt="{{ $comment->user->name }}" 
                     class="w-10 h-10 rounded-full border border-primary">
            </div>
            
            <!-- Comment Content -->
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-white">{{ $comment->user->username }}</span>
                    <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                </div>

                @if(auth()->check() && (auth()->id() == $comment->UID || auth()->user()->is_admin))
                        <form action="{{ route('comment.destroy', $comment->CRID) }}" method="POST" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-400 text-xs flex items-center gap-1 px-2 py-1 rounded hover:bg-red-900/20"
                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </form>
                        @endif
                    
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

    @if(isset($recommended) && $recommended->isNotEmpty())
        @foreach($recommended as $recVideo)
            <a href="{{ route('video.show', $recVideo->VidID) }}" class="flex items-center gap-3 mb-4 group">
                <img src="{{ asset($recVideo->thumbnail ?? 'images/default-thumbnail.jpg') }}" 
                     alt="{{ $recVideo->title }}" 
                     class="rounded-lg w-24 h-14 object-cover border-2 border-primary group-hover:border-blue-400 transition-all">
                <div class="min-w-0">
                    <h4 class="text-sm font-semibold text-white group-hover:text-blue-400 truncate">
                        {{ $recVideo->title }}
                    </h4>
                    <p class="text-gray-400 text-xs">
                        {{ number_format($recVideo->view_count) }} views • 
                        {{ $recVideo->created_at->diffForHumans() }}
                    </p>
                </div>
            </a>
        @endforeach
    @else
        <p class="text-gray-400 text-sm">No recommended videos found</p>
    @endif
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


<script>
    const isSubscribed = '@json($isSubscribed)';

    function toggleSubscription(channelId) {
    fetch(`/subscribe/${channelId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        let btn = document.getElementById('subscribe-btn');
        
        if (data.status === 'subscribed') {
            btn.innerText = 'Unsubscribe';
            btn.classList.replace('bg-blue-500', 'bg-red-500');
        } else {
            btn.innerText = 'Subscribe';
            btn.classList.replace('bg-red-500', 'bg-blue-500');
        }
    });
}
</script>

@endsection