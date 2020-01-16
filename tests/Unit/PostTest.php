<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_tags()
    {
        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Collection::class, $post->tags);
    }

    /** @test */
    public function it_can_sync_tags()
    {
        $post = factory(Post::class)->create();

        $post->syncTags(['Laravel', 'Testing']);

        $this->assertCount(2, $post->tags);
        $this->assertEquals('Laravel', $post->tags[0]->name);
        $this->assertEquals('Testing', $post->tags[1]->name);

        $post->syncTags(['Vue']);

        $this->assertCount(1, $post->refresh()->tags);
        $this->assertEquals('Vue', $post->tags[0]->name);

        $post->syncTags([]);

        $this->assertCount(0, $post->refresh()->tags);
    }
}
