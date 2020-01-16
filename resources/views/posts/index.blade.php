@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    @includeWhen($unpublishedPosts->count(), 'layouts.unpublished-posts')

    @foreach($posts as $post)
        @include('posts.preview')
    @endforeach
</div>
@endsection
