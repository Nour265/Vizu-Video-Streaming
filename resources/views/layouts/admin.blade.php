<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizu - Video Streaming</title>
    <link rel="icon" type="image/png" href="{{ asset('images/vizu.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#38b6ff',
                        darkBackground: '#0f172a', // ✅ Your pre-selected dark blue
                        sidebarDark: '#111827',
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-darkBackground text-white flex">

    <!-- ✅ Sidebar (Always Dark) -->
    <div id="sidebar" class="fixed left-0 top-0 w-60 bg-sidebarDark text-white h-full min-h-screen p-4 transform -translate-x-full transition-transform duration-300">
    <h2 class="text-xl font-bold text-primary mb-6">Menu</h2>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded bg-primary text-black font-semibold">
                    🏠 Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manage.users') }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                    👥 Manage Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manage.videos') }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                    🎥 Manage Videos
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full py-2 px-4 bg-red-500 rounded hover:bg-red-600">
                        🚪 Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- ✅ Main Content -->
    <div id="main-content" class="flex-1 transition-all duration-300 ml-0">
        
        <!-- ✅ Navbar -->
        <nav class="shadow-md fixed w-full top-0 z-50 bg-black text-white px-6 py-3 flex items-center justify-between">
            <!-- ☰ Sidebar Toggle -->
            <button id="sidebar-toggle" class="text-white text-2xl focus:outline-none">&#9776;</button>

            <!-- ✅ User Icon (Top Right) -->
            <div class="relative">
                <button id="user-dropdown-toggle" class="focus:outline-none">
                    <img src="{{ asset('images/user-icon.png') }}" alt="User Icon" class="h-10 w-10 rounded-full border border-gray-500">
                </button>

                <!-- ✅ Dropdown Menu -->
                <div id="user-dropdown" class="absolute right-0 mt-2 w-40 bg-gray-800 border border-gray-700 rounded-lg shadow-lg py-2 hidden transition-opacity duration-300">
                    @auth
                        <!-- ✅ If logged in -->
                        <a href="{{ route('home') }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <!-- ✅ If NOT logged in -->
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-gray-700 transition">Register</a>
                    @endauth
                </div>
            </div>

        </nav>

        <!-- ✅ Main Content -->
        <div class="mt-5 px-6">
            @yield('content')
        </div>
    </div>

    <!-- ✅ Sidebar & User Dropdown Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("main-content");
            const sidebarToggle = document.getElementById("sidebar-toggle");
            const userDropdownToggle = document.getElementById("user-dropdown-toggle");
            const userDropdown = document.getElementById("user-dropdown");

            // ✅ Sidebar toggle logic
            sidebarToggle.addEventListener("click", function () {
                sidebar.classList.toggle("-translate-x-full");
                mainContent.classList.toggle("ml-60");
            });

            // ✅ User dropdown toggle
            userDropdownToggle.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent click from closing immediately
                userDropdown.classList.toggle("hidden");
                userDropdown.classList.toggle("opacity-100");
            });

            // ✅ Close dropdown if clicked outside
            document.addEventListener("click", function (event) {
                if (!userDropdownToggle.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add("hidden");
                    userDropdown.classList.remove("opacity-100");
                }
            });
        });
    </script>

</body>
</html>
