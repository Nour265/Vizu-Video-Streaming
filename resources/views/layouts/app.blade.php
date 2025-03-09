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
                    background: '#000000',
                   
                    
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
<body class="bg-gray-900 text-white" id="theme">

    <!-- Navbar -->
    <nav class="shadow-md fixed w-full top-0 z-50 bg-black text-white">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/vizu.png') }}" alt="Vizu Logo" class="h-8 w-auto">
            <span class="text-primary text-2xl font-bold">Vizu</span>
        </a>

        <!-- Search Bar -->
        <div class="flex-grow mx-6 max-w-lg">
            <div class="relative">
                <input type="text" placeholder="Search videos..."
                    class="w-full px-4 py-2 rounded-full border bg-gray-800 text-white 
                        focus:outline-none focus:ring-2 focus:ring-primary">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-black px-4 py-1 rounded-full">
                    🔍
                </button>
            </div>
        </div>

        <!-- User Authentication Buttons -->
        <div class="flex space-x-4 items-center">
            @auth
                <!-- If user is logged in -->
               
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            @else
                <!-- If user is NOT logged in -->
                <a href="{{ route('login') }}" class="bg-primary text-black px-4 py-2 rounded-md hover:bg-blue-400 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Register</a>
            @endauth
        </div>
    </div>
</nav>



    <!-- Main Content -->
    <div class="mt-20 px-6">
        @yield('content')
    </div>

   





</body>
</html>
