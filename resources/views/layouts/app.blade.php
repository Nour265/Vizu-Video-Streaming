<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizu - Video Streaming</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#38b6ff', // Light blue
                        background: '#000000', // Dark mode background
                        lightBg: '#ffffff', // Light mode background
                        darkGray: '#121212', // Dark gray
                        lightText: '#000000', // Light mode text
                        darkText: '#ffffff', // Dark mode text
                    }
                }
            }
        };
    </script>

    <style>
        .dark-mode {
            background-color: #000000;
            color: #ffffff;
        }
        .light-mode {
            background-color: #ffffff;
            color: #000000;
        }
    </style>
</head>
<body class="transition-all duration-300" id="theme">

    <!-- Navbar -->
    <nav class="py-4 px-6 fixed top-0 left-0 right-0 z-50 flex items-center justify-between shadow-md">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
    <img src="{{ asset('images/vizu.png') }}" alt="Vizu Logo" class="h-8 w-auto">
    <span class="text-primary text-2xl font-bold">Vizu</span>
</a>

        <!-- Search Bar -->
        <div class="flex-grow mx-6 max-w-lg">
            <div class="relative">
                <input type="text" placeholder="Search videos..." 
                    class="w-full px-4 py-2 rounded-full border bg-gray-200 text-black 
                           dark:bg-darkGray dark:text-white 
                           focus:outline-none focus:ring-2 focus:ring-primary">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-black px-4 py-1 rounded-full">
                    🔍
                </button>
            </div>
        </div>

        <!-- Theme Toggle Switch -->
        <div class="flex space-x-4 items-center">
            <button id="theme-toggle" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                🌙 Dark
            </button>
            @if(Auth::check())
                <a href="{{ route('profile') }}" class="hover:text-primary transition">Profile</a>
                <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">Logout</a>
            @else
                <a href="{{ route('login') }}" class="bg-primary text-black px-4 py-2 rounded-md hover:bg-blue-400 transition">Login</a>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <div class="mt-20 px-6">
        @yield('content')
    </div>

    <!-- Theme Switch JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        // Get saved theme or default to 'dark'
        let theme = localStorage.getItem('theme') || 'dark';

        // Apply initial theme without animation on page load
        applyTheme(theme);

        // Toggle theme on button click
        themeToggle.addEventListener('click', function () {
            theme = (theme === 'dark') ? 'light' : 'dark';
            applyTheme(theme);
        });

        function applyTheme(theme) {
            if (theme === 'dark') {
                body.classList.add('dark-mode', 'transition-all', 'duration-300');
                body.classList.remove('light-mode');
                themeToggle.innerHTML = '🌙 Dark';
                themeToggle.classList.replace('bg-gray-200', 'bg-gray-700');
                themeToggle.classList.replace('text-black', 'text-white');
            } else {
                body.classList.add('light-mode', 'transition-all', 'duration-300');
                body.classList.remove('dark-mode');
                themeToggle.innerHTML = '☀️ Light';
                themeToggle.classList.replace('bg-gray-700', 'bg-gray-200');
                themeToggle.classList.replace('text-white', 'text-black');
            }
            localStorage.setItem('theme', theme);
        }
    });
</script>



</body>
</html>
