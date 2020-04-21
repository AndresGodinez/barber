<?php

namespace Tests\Feature;

use App\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BranchesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function customer_only_can_see_the_branches_that_belong_to_him()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $anotherBranches = factory(Branch::class)->times(2)->create();

//        dd(Branch::count()); 2

        $adminCustomerUser = $this->getUserAdminCustomer();

        dd($adminCustomerUser);

        $branches = factory(Branch::class)->times(2)->create([
            'customer_id' => $adminCustomerUser->id
        ]);

//        dd(Branch::count()); 4


        $response = $this->actingAs($adminCustomerUser)->get(route('branches.index'));
        $response->assertStatus(200);
        $response->assertViewIs('branches.index');

        foreach ($anotherBranches as $branch) {
            $response->assertDontSee($branch->name);
            $response->assertDontSee($branch->telephone);
            $response->assertDontSee($branch->address);
            $response->assertDontSee($branch->rfc);
        }

        foreach ($branches as $branch) {
            $response->assertSee($branch->name);
            $response->assertSee($branch->telephone);
            $response->assertSee($branch->address);
            $response->assertSee($branch->rfc);
        }
    }

    /** @test */
    function user_can_see_form_to_create_branch()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();

        $response = $this->actingAs($user)->get(route('branches.create'));
        $response->assertViewIs('branches.create');
        $response->assertSee('Nombre');
        $response->assertSee('Dirección');
        $response->assertSee('Teléfono');
        $response->assertSee('RFC');
        $response->assertSee('Guardar');
    }

    public function user_can_store_new_branch()
    {
        $user = $this->getDefaultUser();

        $response = $this->actingAs($user)->post(route('branches.store'), [
            'name' => $name = $this->faker->name,
            'user_id' => $user->id,
            'address' => $address = $this->faker->address,
            'telephone' => $telephone = $this->faker->phoneNumber,
            'rfc' => $rfc = $this->faker->word . $this->faker->postcode
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => $name,
            'address' => $address,
            'telephone' => $telephone,
            'rfc' => $rfc
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('branches.index'));
    }

    /** @test */
    function user_can_see_the_form_to_edit_branch()
    {
        $user = $this->getDefaultUser();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($user)->get(route('branches.edit', ['branch' => $branch->id]));
        $response->assertViewIs('branches.edit');
        $response->assertSee('Nombre');
        $response->assertSee($branch->name);
        $response->assertSee($branch->address);
        $response->assertSee($branch->rfc);
        $response->assertSee($branch->telephone);
        $response->assertSee('Dirección');
        $response->assertSee('RFC');
        $response->assertSee('Actualizar');
        $response->assertSee('Teléfono');
    }

    /** @test */
    function user_can_edit_branch()
    {
        $user = $this->getDefaultUser();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($user)->put(
            route('branches.update', ['branch' => $branch->id]), [
                'name' => $name = $this->faker->name . '3',
                'address' => $branch->address,
                'telephone' => $branch->telephone,
                'rfc' => $branch->rfc
            ]
        );

        $this->assertDatabaseHas('branches', [
            'name' => $name,
            'address' => $branch->address,
            'telephone' => $branch->telephone,
            'rfc' => $branch->rfc
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('branches.index'));
    }

    /** @test */
    function user_can_show_details_branch()
    {
        $user = $this->getDefaultUser();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($user)->get(
            route('branches.show', ['branch' => $branch->id]));

        $response->assertViewIs('branches.show');

        $response->assertStatus(200);


    }
}
