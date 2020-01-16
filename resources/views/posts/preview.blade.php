<div class="bg-white rounded-lg shadow p-6 mt-4">
    <a href="{{ route('posts.show', $post) }}" class="text-lg leading-none">
        <h6>{{ $post->title }}</h6>
    </a>
    <div class="mt-2">
        <span class="text-gray-700">{{ $post->author->name }}</span>
        <span class="text-gray-500 mx-2">•</span>
        <span class="text-gray-700">{{ $post->published_at->diffForHumans() }}</span>
    </div>
</div>
