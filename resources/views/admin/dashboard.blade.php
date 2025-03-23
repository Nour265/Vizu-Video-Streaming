@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-6 mt-16">
        <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->username }}! 🎉</h1>

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
