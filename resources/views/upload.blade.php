@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-primary text-center mb-8">Upload Your Video</h2>

        <form id="uploadForm" action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="title" class="block text-lg font-semibold text-white">Title:</label>
                <input type="text" name="title" id="title" placeholder="Video Title" class="w-full p-3 border border-gray-600 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-primary transition" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-lg font-semibold text-white">Description:</label>
                <textarea name="description" id="description" placeholder="Video Description" class="w-full p-3 border border-gray-600 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-primary transition" rows="4"></textarea>
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="block text-lg font-semibold text-white">Thumbnail:</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="w-full p-3 border border-gray-600 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-primary transition" required>
            </div>

            <div class="mb-6">
                <label for="video_path" class="block text-lg font-semibold text-white">Video:</label>
                <input type="file" name="video_path" id="video_path" accept="video/*" class="w-full p-3 border border-gray-600 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-primary transition" required>
            </div>

            <div class="mb-6">
                <progress id="uploadProgress" value="0" max="100" class="w-full h-2 bg-gray-600 rounded-md" style="display: none;"></progress>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-6 py-3 bg-primary text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300">
                    Upload
                </button>
            </div>
        </form>
    </div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = e.target;
    let formData = new FormData(form);
    let xhr = new XMLHttpRequest();

    xhr.open('POST', form.action, true);

    xhr.upload.addEventListener('loadstart', () => {
        document.getElementById('uploadProgress').style.display = 'block';
    });

    xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) {
            let percent = (e.loaded / e.total) * 100;
            document.getElementById('uploadProgress').value = percent;
        }
    });

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Upload complete!');
            location.reload();
        } else {
            alert('Upload failed.');
        }
    };

    xhr.send(formData);
});
</script>


@endsection