<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizu - Video Streaming</title>
    <link rel="icon" type="image/png" href="{{ asset('images/vizu.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#38b6ff',
                        darkBackground: '#0f172a',
                        
                    }
                }
            }
        };
    </script>

    <style>
        .dropdown-menu { display: none; }
    </style>
</head>
<body class="bg-darkBackground text-white flex">

    <!-- ✅ Sidebar -->
    <div id="sidebar" class="fixed left-0 top-0 w-60 bg-darkBackground text-white h-full min-h-screen p-4 transform -translate-x-full transition-transform duration-300 border-r border-gray-700">
        <h2 class="text-xl font-bold text-primary mb-6">Menu</h2>
        <ul class="space-y-4">
            <a href="{{ route('home') }}" class="block bg-sky-600 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition text-center">
                Home
            </a>
            <a href="{{ route('contact.show') }}" class="block bg-sky-600 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition text-center">
                Contact Us
            </a>
            <a href="{{ route('about') }}" class="block bg-sky-600 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition text-center">
                 About Us
            </a>
        </ul>
    </div>

    <!-- ✅ Main Content -->
    <div id="main-content" class="flex-1 transition-all duration-300 ml-0">

        <!-- ✅ Navbar -->
        <nav class="shadow-md fixed w-full top-0 z-50 bg-black text-white px-6 py-3 flex items-center justify-between">
            <!-- ☰ Sidebar Toggle -->
            <button id="sidebar-toggle" class="text-white text-2xl focus:outline-none">&#9776;</button>

            <!-- ✅ Search Bar -->
            <div class="flex justify-center flex-grow">
                <div class="relative w-full max-w-lg">
                    <input id="video-search" type="text" placeholder="Search videos..."
                           class="w-full px-4 py-2 rounded-full border border-gray-600 bg-gray-800 text-white
                                  focus:outline-none focus:ring-2 focus:ring-primary transition">
                </div>
            </div>

            <!-- ✅ User Dropdown -->
            <div class="relative">
                <button id="user-dropdown-toggle" class="focus:outline-none">
                    <img src="{{ asset(auth()->user()->profile_picture ?? 'images/user-icon.png') }}" alt="User Icon" class="h-10 w-10 rounded-full border border-gray-500">
                </button>

                <div id="user-dropdown" class="dropdown-menu absolute right-0 mt-2 w-40 bg-gray-800 border border-gray-700 rounded-lg shadow-lg py-2">
                    @auth
                        <a href="{{ route('profile.show', auth()->user()->UID ) }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- ✅ Main Page Content -->
        <div class="mt-20 px-6">
            @yield('content')
        </div>
    </div>

    <!-- ✅ Scripts -->
    <script>
        $(document).ready(function () {
            // Sidebar toggle
            $('#sidebar-toggle').on('click', function () {
                $('#sidebar').toggleClass('-translate-x-full');
                $('#main-content').toggleClass('ml-60');
            });

            // User dropdown toggle
            $('#user-dropdown-toggle').on('click', function (e) {
                e.stopPropagation();
                $('#user-dropdown').toggle();
            });

            // Close dropdown if clicked outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#user-dropdown-toggle, #user-dropdown').length) {
                    $('#user-dropdown').hide();
                }
            });

            // Handle Enter press in search bar
            $('#video-search').on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const query = $(this).val().trim();
                    if (query.length > 0) {
                        window.location.href = '/search?query=' + encodeURIComponent(query);
                    }
                }
            });
            
            $('#video-search').on('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = $(this).val().trim();

                if (query.length > 0) {
                    $.ajax({
                        url: '/search',
                        type: 'GET',
                        data: { query: query },
                        success: function (data) {
                            $('#search-results').html(data);
                        },
                        error: function () {
                            alert('Search failed. Please try again.');
                        }
            });
        }
    }
});
        });
    </script>

</body>
</html>
