@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-5 hidden md:block">
        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
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
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Welcome, Admin! 🎉</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 p-5 rounded-lg text-white shadow-md">
                <h3 class="text-lg font-semibold">Total Users</h3>
                <p class="text-2xl font-bold">1,230</p>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg text-white shadow-md">
                <h3 class="text-lg font-semibold">Total Videos</h3>
                <p class="text-2xl font-bold">540</p>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg text-white shadow-md">
                <h3 class="text-lg font-semibold">New Signups</h3>
                <p class="text-2xl font-bold">12 Today</p>
            </div>
        </div>

        
    </main>
</div>
@endsection
