<?php

namespace App\ViewModels;

use App\Post;
use App\User;
use Illuminate\Contracts\Support\Arrayable;

class PostsViewModel implements Arrayable
{
    /**
     * The user model.
     *
     * @var \App\User
     */
    protected $user;

    /**
     * Create a new view model instance.
     *
     * @param \App\User|null $user
     */
    public function __construct(User $user = null)
    {
        $this->user = $user ?? auth()->user();
    }

    /**
     * Convert the view model to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'posts' => Post::whereNotNull('published_at')
                ->latest('published_at')
                ->paginate(),
            'unpublishedPosts' => Post::whereNull('published_at')
                ->whereUserId($this->user->id)
                ->latest('updated_at')
                ->get()
        ];
    }
}
