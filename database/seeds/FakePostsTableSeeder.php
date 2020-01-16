<?php

use App\Post;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class FakePostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tags = factory(Tag::class, 20)->create()
            ->pluck('name')
            ->all();

        factory(Post::class, 20)->create()
            ->each(function ($post) use ($faker, $tags) {
                $post->syncTags($faker->randomElements($tags, rand(1, 5)));
            });
    }
}
