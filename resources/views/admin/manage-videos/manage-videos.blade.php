@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-16">
<div class="bg-gray-800 text-white shadow-lg rounded-lg p-6">

    <h1 class="text-center text-3xl font-bold text-primary mb-6">Manage Videos</h1>

    <!-- ✅ Search Bar -->
    <div class="mb-6 flex justify-center">
        <form action="{{ route('admin.manage.videos.search') }}" method="GET" class="relative w-full max-w-lg">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search videos..." 
                class="w-full px-4 py-2 rounded-full border border-gray-600 bg-gray-800 text-white 
                    focus:outline-none focus:ring-2 focus:ring-primary transition">
            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-black px-4 py-1 rounded-full font-semibold">
                Search
            </button>
        </form>
    </div>

    <!-- ✅ Table for Videos -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full bg-gray-900 text-white rounded-lg">
            <thead class="bg-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Title</th>
                    <th class="py-3 px-4 text-left">Uploaded By</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                    <td class="py-3 px-4">{{ $video->id }}</td>
                    <td class="py-3 px-4">{{ $video->title }}</td>
                    <td class="py-3 px-4">{{ $video->user->name }}</td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('video.show', $video->VidID) }}" class="btn btn-info">View</a>
                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition ml-2">Edit</a>
                        <!-- Delete Button with Confirmation -->
                        <button onclick="openDeleteModal({{ $video->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition ml-2">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ Pagination -->
    <div class="mt-6">
        {{ $videos->links() }}
    </div>

    <!-- ✅ Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-75 z-50 hidden">
        <div class="bg-gray-800 p-6 rounded-lg text-white w-1/3">
            <h3 class="text-2xl font-semibold mb-4">Confirm Deletion</h3>
            <p class="mb-6">Are you sure you want to delete this video? This action cannot be undone.</p>

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
</div>
</div>

<!-- Modal JavaScript -->
<script>
    function openDeleteModal(videoId) {
        // Set the form action URL dynamically
        document.getElementById('deleteForm').action = "/admin/videos/" + videoId;

        // Show the modal
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        // Hide the modal
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
