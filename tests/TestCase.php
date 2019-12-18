<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $user;

    use CreatesApplication;

    public function getDefaultUser(): User
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $this->setUser();

        return $this->user;

    }

    public function setUser()
    {
        $this->user = factory(User::class)->create([
            'name' => 'Andres',
            'email' => 'ing.a.godinez@gmail.com'
        ]);
    }
}
