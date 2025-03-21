@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Email</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- New Password Field -->
            <div class="mb-4">
                <label class="block text-gray-400">New Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary text-black font-semibold py-2 rounded-lg hover:bg-blue-400 transition">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
