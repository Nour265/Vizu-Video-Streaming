@extends('layouts.app')

@section('content')
<div class="mt-20 flex items-center justify-center">
    <div class="text-white p-8 rounded-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if(session('error'))
            <p class="text-red-500 text-sm mb-4">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    <input type="password" name="password" id="login-password" required
                           class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg pr-16">
                    
                    <!-- Show/Hide Password Button -->
                    <button type="button" id="toggle-login-password"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white text-sm font-medium">
                        Show
                    </button>
                </div>
              
              @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
              @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="text-primary hover:underline text-sm">
        Forgot Password?
    </a>
@endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary text-black font-semibold py-2 rounded-lg hover:bg-blue-400 transition">
                Login
            </button>

            <!-- Register Link -->
            <p class="text-gray-400 text-sm mt-4 text-center">
                Don't have an account? <a href="{{ route('register') }}" class="text-primary hover:underline">Sign Up</a>
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

    setupPasswordToggle("login-password", "toggle-login-password");
});
</script>
@endsection
