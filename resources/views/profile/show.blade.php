@extends('layouts.app')

@section('content')

<div class="mt-16 px-6"> <!-- Adjusted margin-top to account for the fixed navbar -->
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center">
            <!-- Profile Picture -->
            <img src="{{ asset($user->profile_picture ?? 'images/default-profile.png') }}" 
                 alt="Profile Picture" 
                 class="w-32 h-32 rounded-full mx-auto border-4 border-primary">
            <!-- User Name -->
            <h1 class="text-3xl font-bold mt-4">{{ $user->name }}</h1>
            <!-- User Email -->
            <p class="text-gray-400 mt-2">{{ $user->email }}</p>
        </div>

        <!-- Profile Details -->
        <div class="mt-8 bg-gray-800 p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-primary mb-6">About Me</h2>
            <!-- Location -->
            <div class="mb-4">
                <p class="text-gray-400"><strong>Location:</strong> {{ $user->location ?? 'Not specified' }}</p>
            </div>
            <!-- Bio -->
            <div class="mb-4">
                <p class="text-gray-400"><strong>Bio:</strong> {{ $user->bio ?? 'No bio available.' }}</p>
            </div>

            <!-- Edit Profile Button (Only for the logged-in user) -->
            @if(Auth::check() && Auth::id() === $user->id)
                <div class="mt-6 text-center">
                    <a href="{{ route('profile.edit', $user->id) }}" 
                       class="bg-primary text-black px-6 py-2 rounded-full font-semibold hover:bg-primary/90 transition">
                        Edit Profile
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection