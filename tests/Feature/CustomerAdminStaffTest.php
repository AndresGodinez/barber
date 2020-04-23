<?php

namespace Tests\Feature;

use App\Staff;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerAdminStaffTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_customer_admin_user_can_create_user_staff()
    {
        $this->insertRoles();

        $this->withoutExceptionHandling();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->actingAs($adminCustomerUser)->post('staff', [
            'name' => $name = 'Staff Name',
            'username' => $username = 'User Name',
            'customer_id' => $customer_id = $adminCustomerUser->customer->id,
            'commission_percent' => $commission_percent = 20,
            'email' => $emailStaff = 'staffTest@email.com',
        ]);

        $this->assertDatabaseHas('staff', [
            'name' => $name,
            'username' => 'User Name',
            'email' => $emailStaff,
            'customer_id' => $customer_id,
            'commission_percent' => $commission_percent = 20,
        ]);

        $lastStaff = Staff::get()->last();

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'username' => 'User Name',
            'email' => $emailStaff,
            'customer_id' => $adminCustomerUser->customer->id,
            'staff_id' => $lastStaff->id
        ]);

        $lastUserStaff = User::get()->last();

        $this->assertTrue($lastUserStaff->hasRole(['customer_staff']));

    }

    /** @test */
    function a_customer_admin_user_can_see_only_staff_belongs_to_him()
    {
        $this->insertRoles();

        $this->withoutExceptionHandling();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $staffDoNotBelongsToAdminUser = factory(Staff::class)->times(4)->create();

        $staffBelongsToAdminUser = factory(Staff::class)->times(4)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

        $response = $this->actingAs($adminCustomerUser)->get(route('staff.index'));

        foreach ($staffDoNotBelongsToAdminUser as $userDontBelongToUser) {
            $response->assertDontSee($userDontBelongToUser->name);
            $response->assertDontSee($userDontBelongToUser->username);
        }

        foreach ($staffBelongsToAdminUser as $userBelongToUser) {
            $response->assertSee($userBelongToUser->name);
            $response->assertSee($userBelongToUser->username);
        }
    }
}
