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
                        primary: '#38b6ff',
                        background: '#1e1e1e',
                    }
                }
            }
        };
    </script>

    <style>
        /* ✅ Sidebar Hidden by Default */
        .sidebar-hidden {
            transform: translateX(-100%);
        }
    </style>
</head>
<body class="bg-gray-900 text-white flex">

    <!-- ✅ Sidebar (Hidden Initially) -->
    <div id="sidebar" class="w-60 bg-black text-white h-screen fixed left-0 top-0 sidebar-hidden transition-transform duration-300 p-4">
        <h2 class="text-xl font-bold text-primary mb-6">Menu</h2>
        <ul class="space-y-4">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block bg-primary text-black px-4 py-2 rounded-md hover:bg-blue-400 transition text-center">Login</a>
                <a href="{{ route('register') }}" class="block bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition text-center">Register</a>
            @endauth
        </ul>
    </div>

    <!-- ✅ Main Content (No Sidebar Space Taken When Closed) -->
    <div id="main-content" class="flex-1 transition-all duration-300">
        
        <!-- Navbar -->
        <nav class="shadow-md fixed w-full top-0 z-50 bg-black text-white px-6 py-3 flex items-center justify-between">
            <!-- Left: Sidebar Toggle Button -->
            <button id="sidebar-toggle" class="text-white text-2xl focus:outline-none">&#9776;</button>  <!-- ☰ Sidebar Toggle -->

            <!-- ✅ Centered Search Bar -->
            <div class="flex justify-center flex-grow">
                <form action="{{ route('videos.search') }}" method="GET" class="relative w-full max-w-lg">
                    <input type="text" name="query" placeholder="Search videos..." 
                        class="w-full px-4 py-2 rounded-full border border-gray-600 bg-gray-800 text-white 
                               focus:outline-none focus:ring-2 focus:ring-primary transition">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-black px-4 py-1 rounded-full font-semibold">
                        Search
                    </button>
                </form>
            </div>

            <!-- ✅ Right: Logo + VIZU Text -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/vizu.png') }}" alt="Vizu Logo" class="h-10 w-auto max-h-10">
                <span class="text-primary text-2xl font-bold">VIZU</span>  <!-- ✅ Added Text Next to Logo -->
            </a>
        </nav>

        <!-- Content Section -->
        <div class="mt-20 px-6">
            @yield('content')
        </div>
    </div>

    <!-- ✅ JavaScript for Sidebar Toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebar-toggle");

            sidebarToggle.addEventListener("click", function () {
                sidebar.classList.toggle("sidebar-hidden");
            });
        });
    </script>

</body>
</html>
