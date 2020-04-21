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
    function an_administrator_can_create_customer()
    {
        $this->withoutExceptionHandling();

        $this->createSystemAdminRole();

        $user = factory(User::class)->create();
        $user->assignRole('system_admin');
        $type = factory(Type::class)->create([
            'name' => 'trial',
            'months' => 1,
        ]);

        $response = $this->actingAs($user)->post(route('customer.store', [
            'name' => $name = 'Test',
            'last_name' => $las_name = 'Name',
            'expiration' => $expirationDate = Carbon::now()->addMonth(),
            'telephone' => $telephone = '55555589',
            'email' => $email = $this->faker->email,
            'type_id' => $type->id
        ]));

        $this->assertDatabaseHas('customers',[
            'name' => $name,
            'last_name' => $las_name,
            'telephone' => $telephone,
            'expiration' => $expirationDate,
            'email' => $email,
            'type_id' => $type->id
        ]);

        $inUserName = 'Test'.' '.$las_name;

        $this->assertDatabaseHas('users',[
            'name' => $inUserName ,
            'userName' => 'TName',
            'email' => $email,
        ]);

        $response->assertRedirect(route('customers.index'));
    }

    /** @test */
    function an_administrator_can_show_customers()
    {
        $this->createSystemAdminRole();

        $user = factory(User::class)->create();

        $user->assignRole('system_admin');

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
