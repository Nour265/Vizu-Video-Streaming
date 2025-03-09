@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Username Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Username</label>
                <input type="text" name="username" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
                @error('username') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-400">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:ring focus:ring-primary">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4 relative">
                <label class="block text-gray-400">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="register-password" required
                           class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg pr-16">
                    
                    <!-- Show/Hide Password Button -->
                    <button type="button" id="toggle-register-password"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white text-sm font-medium">
                        Show
                    </button>
                </div>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-4 relative">
                <label class="block text-gray-400">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="confirm-password" required
                           class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg pr-16">
                    
                    <!-- Show/Hide Confirm Password Button -->
                    <button type="button" id="toggle-confirm-password"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white text-sm font-medium">
                        Show
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary text-black font-semibold py-2 rounded-lg hover:bg-blue-400 transition">
                Sign Up
            </button>

            <!-- Login Link -->
            <p class="text-gray-400 text-sm mt-4 text-center">
                Already have an account? <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a>
            </p>
        </form>
    </div>
</div>

<!-- JavaScript for Password Toggle -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    function setupPasswordToggle(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const toggleButton = document.getElementById(toggleId);

        toggleButton.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                toggleButton.textContent = "Show";
            }
        });
    }

    setupPasswordToggle("register-password", "toggle-register-password");
    setupPasswordToggle("confirm-password", "toggle-confirm-password");
});
</script>
@endsection
