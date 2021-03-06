<div>
    <label class="inline-block text-gray-600 mb-2">Title</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('title', $post->title) }}"
        placeholder="Title of your blog"
        name="title"
        type="text"
        autofocus>

    @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Body</label>

    <textarea
        class="block w-full px-3 py-2 h-48 bg-white rounded shadow appearance-none resize-none focus:outline-none"
        placeholder="Write something nice"
        name="body">{{ old('body', $post->body) }}</textarea>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Cover Image</label>

    <photo-upload
        value="{{ old('cover', $post->cover) }}"
        v-on:input="$refs.cover.value = $event"></photo-upload>

    <input
        value="{{ old('cover', $post->cover) }}"
        type="hidden"
        name="cover"
        ref="cover">

    @error('cover')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Publish Date</label>

    <date-time-picker
        value="{{ old('published_at', $post->published_at) }}"
        v-on:input="$refs.published_at.value = $event"></date-time-picker>

    <input
        value="{{ old('published_at', $post->published_at) }}"
        name="published_at"
        ref="published_at"
        type="hidden">

    @error('published_at')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Tags</label>

    <tags-input name="tags[]" v-bind:value='@json(old("tags", $post->tags->pluck("name")->toArray()))'></tags-input>
</div>

<div class="mt-10">
    <button class="px-4 h-12 rounded bg-gray-700 text-white" type="submit">{{ $buttonText }}</button>
</div>
