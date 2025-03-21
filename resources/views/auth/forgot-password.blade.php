@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>

        @if (session('status'))
            <p class="text-green-500 text-sm mb-4">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary text-black font-semibold py-2 rounded-lg hover:bg-blue-400 transition">
                Send Password Reset Link
            </button>

            <!-- Back to Login -->
            <p class="text-gray-400 text-sm mt-4 text-center">
                <a href="{{ route('login') }}" class="text-primary hover:underline">Back to Login</a>
            </p>
        </form>
    </div>
</div>
@endsection
