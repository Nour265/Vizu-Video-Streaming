@extends('layouts.app')

@section('content')
<div class="pt-20 px-6">
    <h2 class="text-3xl font-bold mb-6 text-primary">Trending Videos</h2>

    <div id="search-results">
        @include('videos.search-results', ['videos' => $videos])
    </div>
</div>
@endsection
