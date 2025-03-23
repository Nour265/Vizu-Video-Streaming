@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-gray-800 text-white shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold text-primary mb-6">Edit User</h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-semibold">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="w-full p-2 bg-gray-900 text-white rounded-md" required>
            </div>

            <!-- Email (Disabled) -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full p-2 bg-gray-900 text-white rounded-md" disabled>
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-semibold">Role</label>
                <select name="role" id="role" class="w-full p-2 bg-gray-900 text-white rounded-md" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block text-sm font-semibold">Bio</label>
                <textarea name="bio" id="bio" class="w-full p-2 bg-gray-900 text-white rounded-md">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-semibold">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" class="w-full p-2 bg-gray-900 text-white rounded-md">
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-sm font-semibold">Gender</label>
                <select name="gender" id="gender" class="w-full p-2 bg-gray-900 text-white rounded-md">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Age -->
            <div class="mb-4">
                <label for="age" class="block text-sm font-semibold">Age</label>
                <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}" class="w-full p-2 bg-gray-900 text-white rounded-md">
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
