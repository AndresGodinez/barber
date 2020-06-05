<?php

namespace Tests;

use App\Customer;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    protected $user;
    protected $systemAdminUser;
    protected $userAdminCustomer;
    protected $userStaffCustomer;

    use CreatesApplication;

    public function getSystemAdminUser(): User
    {
        if (!is_null($this->systemAdminUser)) {
            return $this->systemAdminUser;
        }

        $this->setAdminUser();

        return $this->systemAdminUser;

    }

    public function getDefaultUser(): User
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $this->setUser();

        return $this->user;

    }

    public function getUserAdminCustomer()
    {
        if (!is_null($this->userAdminCustomer)) {
            return $this->userAdminCustomer;
        }

        $this->setUserAdminCustomer();

        return $this->userAdminCustomer;
    }

    public function getUserStaffCustomer()
    {
        if (!is_null($this->userStaffCustomer)) {
            return $this->userStaffCustomer;
        }

        $this->setUserStaffCustomer();

        return $this->userStaffCustomer;
    }

    public function setUser()
    {
        $this->user = factory(User::class)->create([
            'name' => 'Andres',
            'email' => 'ing.a.godinez@gmail.com'
        ]);
    }

    private function setAdminUser()
    {
        $this->systemAdminUser = factory(User::class)->create([
            'name' => 'Andres',
            'email' => 'ing.a.godinez@gmail.com'
        ]);

        Role::firstOrCreate([
            'name' => 'system_admin'
        ]);

        $this->systemAdminUser->assignRole('system_admin');
    }

    private function setUserAdminCustomer()
    {
        $this->userAdminCustomer = factory(User::class)->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'customer_id' => function () {
                return factory(Customer::class);
            }
        ]);

        Role::firstOrCreate([
            'name' => 'customer_admin'
        ]);

        $this->userAdminCustomer->assignRole('customer_admin');
    }

    private function setUserStaffCustomer()
    {
        $this->userStaffCustomer = factory(User::class)->create([
            'name' => 'Staff Customer',
            'email' => 'staff@gmail.com'
        ]);

        Role::firstOrCreate([
            'name' => 'customer_staff'
        ]);

        $this->userStaffCustomer->assignRole('customer_staff');
    }

    public function insertRoles()
    {
        Role::create(['name' => 'system_admin']);
        Role::create(['name' => 'customer_admin']);
        Role::create(['name' => 'customer_staff']);
    }

}
