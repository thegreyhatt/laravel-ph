<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_posts()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->posts);
    }
}
