<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_visit_all_posts_page()
    {
        $this->signIn();

        $post = factory(Post::class)->create();

        $this->get(route('posts.index'))
            ->assertSuccessful()
            ->assertSee($post->title);
    }

    /** @test */
    public function a_user_can_visit_single_post_page()
    {
        $this->signIn();

        $post = factory(Post::class)->create();

        $this->get(route('posts.show', $post))
            ->assertSuccessful()
            ->assertSee($post->title);
    }

    /** @test **/
    public function a_user_can_visit_create_post_page()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get(route('posts.create'))->assertSuccessful();
    }

    /** @test */
    public function a_user_can_create_a_post()
    {
        $values = factory(Post::class)->raw();

        $this->signIn($values['user_id']);

        $this->post(route('posts.store'), $values);

        $this->assertDatabaseHas('posts', $values);
    }

    /** @test **/
    public function a_user_can_visit_edit_post_page()
    {
        $post = factory(Post::class)->create();

        $this->signIn($post->author);

        $this->get(route('posts.edit', $post))->assertSuccessful();
    }

    /** @test */
    public function a_user_can_update_a_post()
    {
        $post = factory(Post::class)->create();

        $this->signIn($post->author);

        $values = factory(Post::class)->raw(['user_id' => $post->user_id]);

        $this->patch(route('posts.update', $post), $values);

        $this->assertDatabaseHas('posts', $values);
    }

    /** @test */
    public function a_user_can_delete_a_post()
    {
        $post = factory(Post::class)->create();

        $this->signIn($post->author);

        $this->delete(route('posts.destroy', $post));

        $this->assertDatabaseMissing('posts', $post->only('id'));
    }

    /** @test */
    public function unpublished_posts_should_appear_in_all_posts_page()
    {
        $post = factory(Post::class)->create(['published_at' => null]);

        $this->signIn($post->author);

        $this->get(route('posts.index'))
            ->assertSuccessful()
            ->assertSee($post->title);
    }

    /** @test **/
    public function only_the_author_may_see_unpublished_post()
    {
        $this->signIn();

        $post = factory(Post::class)->create(['published_at' => null]);

        $this->get(route('posts.show', $post))->assertNotFound();
    }

    /** @test **/
    public function only_the_author_may_visit_edit_post_page()
    {
        $this->signIn();

        $post = factory(Post::class)->create();

        $this->get(route('posts.edit', $post))->assertForbidden();
    }

    /** @test **/
    public function only_the_author_may_update_the_post()
    {
        $this->signIn();

        $post = factory(Post::class)->create();

        $this->patch(route('posts.update', $post))->assertForbidden();
    }

    /** @test **/
    public function only_the_author_may_delete_the_post()
    {
        $this->signIn();

        $post = factory(Post::class)->create();

        $this->delete(route('posts.destroy', $post))->assertForbidden();
    }

    /** @test */
    public function tags_can_be_added_as_part_of_a_post()
    {
        $values = factory(Post::class)->raw();

        $values['tags'] = ['Laravel', 'Testing'];

        $this->signIn($values['user_id']);

        $this->post(route('posts.store'), $values);

        $this->assertCount(2, Post::first()->tags);
    }

    /** @test */
    public function tags_can_be_updated_as_part_of_a_post()
    {
        $post = factory(Post::class)->create();

        $values = factory(Post::class)->raw(['user_id' => $post->user_id]);

        $values['tags'] = ['Laravel', 'Testing'];

        $this->signIn($post->author);

        $this->patch(route('posts.update', $post), $values);

        $this->assertCount(2, Post::first()->tags);
    }
}
