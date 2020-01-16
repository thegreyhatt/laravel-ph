<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Authenticate a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|integer|null $user
     * @return $this
     */
    public function signIn($user = null)
    {
        if (! $user) {
            $user = factory(User::class)->create();
        } else if (! $user instanceof Authenticatable) {
            $user = User::findOrFail($user);
        }

        return $this->actingAs($user);
    }
}
