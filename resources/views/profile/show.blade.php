@extends('layouts.app')

@section('content')

<div class="mt-16 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center">
            <img src="{{ asset($user->profile_picture ?? 'images/user-icon.png') }}" 
                 alt="Profile Picture" 
                 class="w-32 h-32 rounded-full mx-auto border-4 border-primary">

            <h1 class="text-3xl font-bold mt-4">{{ $user->username }}</h1>

            <p class="text-gray-400 mt-2">{{ $user->email }}</p>
        </div>

        <div class="mt-8 bg-gray-800 p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-primary mb-6">About Me</h2>

            <div class="mb-4">
                <p class="text-gray-400"><strong>Location:</strong> {{ $user->location ?? 'Not specified' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-400"><strong>Bio:</strong> {{ $user->bio ?? 'No bio available.' }}</p>
            </div>

                <div class="mt-6 text-center">
                <a href="{{ route('profile.edit', ['user' => $user->UID]) }}"
                class="bg-primary text-black px-6 py-2 rounded-full font-semibold hover:bg-primary/90 transition">
                    Edit Profile
                </a>
                </div>
        </div>
    </div>
</div>

@endsection