<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

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

    public function createSystemAdminRole()
    {
        return Role::create([
            'name' => 'system_admin'
        ]);
    }

    public function createAdminRole()
    {
        return Role::create([
            'name' => 'admin'
        ]);
    }
}
