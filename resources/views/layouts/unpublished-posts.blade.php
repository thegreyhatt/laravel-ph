<div class="bg-gray-300 rounded p-6 mt-4">
    <h3 class="font-semibold inline-flex items-center">
        <svg class="w-6 h-6 fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <span class="text-gray-700 ml-2">You have unpublished posts ({{ $unpublishedPosts->count() }})</span>
    </h3>
    @foreach($unpublishedPosts as $post)
        <div class="flex items-center justify-between bg-white p-6 rounded mt-4">
            <div>
                <div class="text-lg leading-none">{{ $post->title }}</div>
                <div class="text-gray-700 mt-2">Updated {{ $post->updated_at->diffForHumans() }}</div>
            </div>
            <div>
                <a href="{{ route('posts.edit', $post) }}" class="inline-block px-3 py-2 rounded text-gray-700 font-medium tracking-wide">Edit</a>
            </div>
        </div>
    @endforeach
</div>
