<?php

namespace App\ViewModels;

use App\Post;
use Illuminate\Contracts\Support\Arrayable;

class PostViewModel implements Arrayable
{
    /**
     * The post model.
     *
     * @var \App\Post
     */
    protected $post;

    /**
     * Create a new view model instance.
     *
     * @param \App\Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Convert the view model to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'post' => $this->post,
            'nextPost' => Post::where('id', '>', $this->post->id)
                ->orderBy('id', 'asc')
                ->first(),
            'previousPost' => Post::where('id', '<', $this->post->id)
                ->orderBy('id', 'desc')
                ->first()
        ];
    }
}
