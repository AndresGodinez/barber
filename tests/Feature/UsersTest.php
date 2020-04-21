<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function create_system_admin_user()
    {
        $user = $this->getSystemAdminUser();

        $this->assertTrue($user->hasRole('system_admin'));
    }

    /** @test */
    function create_admin_customer_user()
    {
        $user = $this->getUserAdminCustomer();

        $this->assertTrue($user->hasRole('customer_admin'));
    }

    /** @test */
    public function get_user_staff_customer()
    {
        $user = $this->getUserStaffCustomer();

        $this->assertTrue($user->hasRole('customer_staff'));

    }


}
