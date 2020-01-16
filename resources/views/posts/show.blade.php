@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="flex items-end justify-between mt-6">
        <div class="flex items-center mt-6">
            <img class="rounded-full h-16 w-16 object-cover border-2" src="{{ $post->author->avatar }}" alt="{{ $post->author->name }} avatar">
            <div class="ml-4">
                {{ $post->author->name }}
                <div class="text-gray-600 text-sm">{{ $post->author->bio }}</div>
                @if ($post->published_at)
                <div class="text-gray-600 text-sm">{{ $post->published_at->diffForHumans() }}</div>
                @else
                <div class="mt-2">
                    <span class="px-2 py-1 rounded text-sm font-semibold uppercase bg-gray-200 text-gray-500">Unpublished</span>
                </div>
                @endif
            </div>
        </div>

        @can('update', $post)
        <div>
            <a href="{{ route('posts.edit', $post) }}" class="inline-block px-3 py-2 border-2 rounded font-medium text-gray-700 focus:outline-none">Edit</a>
        </div>
        @endcan
    </div>

    @if($post->cover)
        <img class="w-full rounded-lg mt-6 shadow-md" src="{{ $post->cover }}" alt="{{ $post->title }}">
    @endif

    <h1 class="text-3xl font-semibold leading-none tracking-tight mt-6">{{ $post->title }}</h1>

    @if($post->tags->count())
        <div class="flex mt-6">
            @foreach($post->tags as $tag)
            <span class="px-2 py-1 rounded bg-gray-300 text-sm text-gray-700 font-medium tracking-wider mr-2 mb-2">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif

    @if($post->body)
        <div class="text-gray-700 leading-loose mt-6">
            {{ $post->body }}
        </div>
    @endif

    <div class="border-t flex justify-between mt-6 py-6">
        <div class="w-48 overflow-hidden">
            @if($previousPost)
            <a href="{{ route('posts.show', $previousPost) }}">
                <div class="text-gray-600">Previous</div>
                <h6 class="truncate">{{ $previousPost->title }}</h6>
            </a>
            @endif
        </div>

        <div class="w-48 text-right overflow-hidden">
            @if($nextPost)
            <a href="{{ route('posts.show', $nextPost) }}">
                <div class="text-gray-600">Next</div>
                <h6 class="truncate">{{ $nextPost->title }}</h6>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
