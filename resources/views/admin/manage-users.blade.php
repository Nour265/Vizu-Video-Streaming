@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-gray-800 text-white shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold text-primary mb-6">Manage Users</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-900 text-white rounded-lg">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                        <td class="py-3 px-4">{{ $user->id }}</td>
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-md text-sm 
                                {{ $user->role == 'admin' ? 'bg-red-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md transition">Edit</a>
                            <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition ml-2">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
