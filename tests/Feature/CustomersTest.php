<?php

namespace Tests\Feature;

use App\Customer;
use App\Type;
use App\User;
use App\Utils\StringUtils;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function a_system_administrator_can_create_customer_and_customer_has_role_admin_customer()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $systemAdminUser = $this->getSystemAdminUser();

        $type = factory(Type::class)->create([
            'name' => 'trial',
            'months' => 1,
        ]);

        $response = $this->actingAs($systemAdminUser)->post(route('customer.store', [
            'name' => $name = 'Test',
            'last_name' => $las_name = 'Name',
            'expiration' => $expirationDate = Carbon::now()->addMonth(),
            'telephone' => $telephone = '55555589',
            'email' => $email = $this->faker->email,
            'type_id' => $type->id
        ]));

        $this->assertDatabaseHas('customers', [
            'name' => $name,
            'last_name' => $las_name,
            'telephone' => $telephone,
            'expiration' => $expirationDate,
            'email' => $email,
            'type_id' => $type->id
        ]);

        $inUserName = 'Test' . ' ' . $las_name;

        $this->assertDatabaseHas('users', [
            'name' => $inUserName,
            'userName' => 'TName',
            'email' => $email,
        ]);

        $response->assertRedirect(route('customers.index'));

        $users = User::get();
        $lastUser = $users->last();
        $this->assertTrue($lastUser->hasRole('customer_admin'));

    }

    protected function insertRoles()
    {
        Role::create(['name' => 'system_admin']);
        Role::create(['name' => 'customer_admin']);
        Role::create(['name' => 'customer_staff']);
    }

    /** @test */
    function an_system_administrator_can_show_customers()
    {

        $user = $this->getSystemAdminUser();

        $customers = factory(Customer::class, 5)->create();

        $response = $this->actingAs($user)->get(route('customers.index'));

        $response->assertViewIs('customers.index');

        foreach ($customers as $customer) {
            $this->assertDatabaseHas('customers', [
                'name' => $customer->name,
                'last_name' => $customer->last_name,
                'expiration' => $customer->expiration
            ]);

            $this->assertDatabaseHas('users', [
                'email' => $customer->email,
                'username' => StringUtils::getUserName($customer->name, $customer->last_name),
            ]);

            $response->assertSee($customer->name);
            $response->assertSee($customer->email);
        }
    }


}
