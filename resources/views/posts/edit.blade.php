@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h1 class="text-lg font-semibold text-gray-700 tracking-tight pb-2 border-b mb-8">Edit Post</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('posts.form', [
            'buttonText' => 'Update Post'
        ])
    </form>
</div>
@endsection
