@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="text-white p-8 rounded-lg  w-full max-w-lg">
        <h2 class="text-3xl font-bold mb-6 text-center text-primary">Contact Us</h2>

        @if(session('success'))
            <p class="bg-green-600 text-white p-3 rounded-md text-center">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Your Name</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Your Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
            </div>

            <!-- Message Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Your Message</label>
                <textarea name="message" rows="4" required
                          class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary text-black font-semibold py-2 rounded-lg hover:bg-blue-400 transition">
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection
