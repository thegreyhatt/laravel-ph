<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'title' => $title = $faker->sentence,
        'body' => $faker->paragraph,
        'cover' => 'https://source.unsplash.com/random/800x600/?id=' . rand(),
        'published_at' => now(),
    ];
});
