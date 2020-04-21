<?php

namespace Tests\Feature;

use App\Type;
use App\User;
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

        $role = Role::create([
            'name' => 'system_admin'
        ]);

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

    }
}
