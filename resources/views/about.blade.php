@extends('layouts.app')

@section('content')
<div class="pt-10 px-6 max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold text-primary mb-4">About Vizu</h1>
    <p class="text-gray-300 mb-6">
        Vizu is a modern video streaming platform built with Laravel. Our goal is to deliver a seamless experience for users to stream and interact with videos in a fast, intuitive environment.
    </p>
    <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 text-center text-gray-300 mb-12">
    <div>
        <h3 class="text-xl font-semibold text-white mb-2">🎬 Endless Entertainment</h3>
        <p>Watch trending, educational, and original videos from creators across the globe.</p>
    </div>
    <div>
        <h3 class="text-xl font-semibold text-white mb-2">🌍 Global Community</h3>
        <p>Connect with creators and viewers from all walks of life. Discover diverse voices.</p>
    </div>
    <div>
        <h3 class="text-xl font-semibold text-white mb-2">📱 Anytime, Anywhere</h3>
        <p>Enjoy videos on any device with a responsive design and lightning-fast performance.</p>
    </div>
</div>

    <div class="py-12 px-4 bg-darkBackground text-white">
    <h2 class="text-3xl font-bold text-center text-primary mb-10">Meet the Developers</h2>

    <div class="flex flex-wrap justify-center gap-10">
        <!-- Developer Card 1 -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6 w-80 text-center">
            <img src="{{ asset('images/Nour.jpg') }}" alt="Developer 1"
                class="w-32 h-40 mx-auto rounded-full object-cover border-4 border-primary mb-4">
            <h3 class="text-xl font-semibold mb-2">Nour Ghannam</h3>
            <p class="text-sm text-gray-400 mb-2">Junior Computer Science Student</p>
            <p class="text-sm text-gray-300">
                Passionate about Laravel and building smart video platforms with clean UI and secure backend logic.
            </p>
        </div>

        <!-- Developer Card 2 -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6 w-80 text-center">
            <img src="{{ asset('images/Bahaa.jpg') }}" alt="Developer 2"
                class="w-32 h-40 mx-auto rounded-full object-cover border-4 border-primary mb-4">
            <h3 class="text-xl font-semibold mb-2">Bahaa Mattar</h3>
            <p class="text-sm text-gray-400 mb-2">Junior Computer Science Student</p>
            <p class="text-sm text-gray-300">
                Specializes in sleek UI, backend handling and creating intuitive interfaces for a seamless user experience.
            </p>
        </div>

        <!-- Developer Card 3 -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6 w-80 text-center">
            <img src="{{ asset('images/Ghadi.jpg') }}" alt="Developer 3"
                class="w-32 h-40 mx-auto rounded-full object-cover border-4 border-primary mb-4">
            <h3 class="text-xl font-semibold mb-2">Ghadi Abou Khzam</h3>
            <p class="text-sm text-gray-400 mb-2">Junior Computer Science Student</p>
            <p class="text-sm text-gray-300">
                Experienced in building useful and advanced web applications, handling both frontend and backend.
            </p>
        </div>
   
    </div>
    <div class="text-center mt-16">
    <h2 class="text-2xl font-bold text-primary mb-2">Join the Vizu Community</h2>
    <p class="text-gray-300 mb-4">Become a part of the next generation of content creators and viewers.</p>
    <a href="{{ route('home') }}" class="mt-5 bg-primary text-black font-semibold px-6 py-2 rounded-lg hover:bg-blue-400 transition">Get Started</a>
</div>
</div>

@endsection
