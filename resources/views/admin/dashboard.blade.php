@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen bg-gray-900 text-white">
    <main class="flex-1 p-6 mt-16">
        <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->username }}! 🎉</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 p-5 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-2xl font-bold">{{ $userCount }}</p>
                </div>
                <i class="fas fa-users text-3xl"></i>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Videos</h3>
                    <p class="text-2xl font-bold">{{ $videoCount }}</p>
                </div>
                <i class="fas fa-video text-3xl"></i>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">New Signups</h3>
                    <p class="text-2xl font-bold">{{ $newUsersToday }}</p>
                </div>
                <i class="fas fa-user-plus text-3xl"></i>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                @foreach($recentVideos as $video)
                    <p class="mb-2">🎬 <strong>{{ $video->title }}</strong> uploaded by <strong>{{ $video->user->username }}</strong></p>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.manage.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center">Manage Users</a>
            <a href="{{ route('admin.manage.videos') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center">Manage Videos</a>
        </div>
    </main>
</div>
@endsection
