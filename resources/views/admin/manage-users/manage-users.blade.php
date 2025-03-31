@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-16">
    <div class="bg-gray-800 text-white shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold text-primary mb-6">Manage Users</h1>

        <!-- ✅ Search Bar -->
        <div class="flex justify-center flex-grow mb-6">
            <form action="{{ route('admin.manage.users.search') }}" method="GET" class="relative w-full max-w-lg">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by username..." 
                    class="w-full px-4 py-2 rounded-full border border-gray-600 bg-gray-800 text-white 
                           focus:outline-none focus:ring-2 focus:ring-primary transition">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-black px-4 py-1 rounded-full font-semibold">
                    Search
                </button>
            </form>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-900 text-white rounded-lg">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Username</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                        <td class="py-3 px-4">{{ $user->UID }}</td>
                        <td class="py-3 px-4">{{ $user->username }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-md text-sm 
                                {{ $user->role == 'admin' ? 'bg-red-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.users.edit', $user->UID) }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md transition">Edit</a>

                            <!-- Delete Button with Confirmation -->
                            <button onclick="openDeleteModal({{ $user->UID }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-75 z-50 hidden">
    <div class="bg-gray-800 p-6 rounded-lg text-white w-1/3">
        <h3 class="text-2xl font-semibold mb-4">Confirm Deletion</h3>
        <p class="mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-between">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Confirm Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal JavaScript -->
<script>
    function openDeleteModal(userId) {
        // Set the form action URL dynamically
        document.getElementById('deleteForm').action = "/admin/users/" + userId;

        // Show the modal
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        // Hide the modal
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
