<?php

namespace App\Http\Controllers;

use App\Post;
use App\ViewModels\PostsViewModel;
use App\ViewModels\PostViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', new PostsViewModel());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);

        $attributes['user_id'] = $request->user()->id;

        $post = Post::create($attributes);

        if ($tags = $request->tags) {
            $post->syncTags($tags);
        }

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Gate::inspect('view', $post)->denied()) {
            abort(404);
        }

        return view('posts.show', new PostViewModel($post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize($post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize($post);

        $attributes = $this->validateRequest($request);

        $post->update($attributes);

        if ($tags = $request->tags) {
            $post->syncTags($tags);
        }

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);

        $post->delete();
    }

    /**
     * Validate the form request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateRequest($request)
    {
        return Arr::except($request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'cover' => ['nullable', 'url'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['required', 'string', 'max:20']
        ]), ['tags']);
    }
}
