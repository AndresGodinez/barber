<?php

namespace Tests\Feature;

use App\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerAdminBranchesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function customer_only_can_see_the_branches_that_belong_to_him()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $anotherBranches = factory(Branch::class)->times(2)->create();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $branches = factory(Branch::class)->times(2)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

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
    function admin_customer_user_can_see_form_to_create_branch()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $response = $this->actingAs($adminCustomerUser)
            ->get(route('branches.create'));

        $response->assertViewIs('branches.create');

        $response->assertSee('Nombre');
        $response->assertSee('Dirección');
        $response->assertSee('Teléfono');
        $response->assertSee('RFC');
        $response->assertSee('Guardar');
    }

    /** @test */
    function customer_staff_user_can_not_see_form_to_create_branch()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $staffUser = $this->getUserStaffCustomer();

        $response = $this->actingAs($staffUser)
            ->get(route('branches.create'));

        $response->assertRedirect(route('home'));

    }

    /** @test */
    public function customer_admin_user_can_store_new_branch()
    {
        $this->insertRoles();

        $customerAdminUser = $this->getUserAdminCustomer();

        $response = $this->actingAs($customerAdminUser)
            ->post(route('branches.store'), [
            'name' => $name = $this->faker->name,
            'address' => $address = $this->faker->address,
            'telephone' => $telephone = $this->faker->phoneNumber,
            'rfc' => $rfc = $this->faker->word . $this->faker->postcode
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => $name,
            'address' => $address,
            'telephone' => $telephone,
            'rfc' => $rfc,
            'customer_id' => $customerAdminUser->customer->id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('branches.index'));
    }


    /** @test */
    public function customer_staff_user_can_not_store_new_branch()
    {
        $this->insertRoles();

        $customerStaffUser = $this->getUserStaffCustomer();

        $response = $this->actingAs($customerStaffUser)
            ->post(route('branches.store'), [
                'name' => $name = $this->faker->name,
                'address' => $address = $this->faker->address,
                'telephone' => $telephone = $this->faker->phoneNumber,
                'rfc' => $rfc = $this->faker->word . $this->faker->postcode
            ]);

        $this->assertDatabaseMissing('branches', [
            'name' => $name,
            'address' => $address,
            'telephone' => $telephone,
            'rfc' => $rfc,
            'customer_id' => $customerStaffUser->customer->id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /** @test */
    function customer_admin_user_can_see_the_form_to_edit_branch()
    {
        $this->insertRoles();

        $customerAdminUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create([
            'customer_id' => $customerAdminUser->customer->id
        ]);

        $response = $this->actingAs($customerAdminUser)
            ->get(route('branches.edit', ['branch' => $branch->id]));

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
    function customer_admin_user_can_not_edit_branch_doesnt_belongs_to_him()
    {
        $this->insertRoles();

        $customerAdminUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($customerAdminUser)
            ->get(route('branches.edit', ['branch' => $branch->id]));

        $response->assertStatus(403);

    }

    /** @test */
    function customer_admin_user_can_edit_branch_it_is_belongs_to_him()
    {
        $this->insertRoles();
        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

        $response = $this->actingAs($adminCustomerUser)->put(
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
    function customer_admin_user_can_not_edit_branch_it_is_doesnt_belongs_to_him()
    {
        $this->insertRoles();
        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($adminCustomerUser)->put(
            route('branches.update', ['branch' => $branch->id]), [
                'name' => $name = $this->faker->name . '3',
                'address' => $branch->address,
                'telephone' => $branch->telephone,
                'rfc' => $branch->rfc
            ]
        );

        $this->assertDatabaseMissing('branches', [
            'name' => $name,
        ]);

        $response->assertStatus(403);

    }

    /** @test */
    function admin_customer_user_can_show_details_branch_it_is_belongs_to_him()
    {
        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

        $response = $this->actingAs($adminCustomerUser)->get(
            route('branches.show', ['branch' => $branch->id]));

        $response->assertViewIs('branches.show');

        $response->assertStatus(200);
    }

    /** @test */
    function admin_customer_user_can_not_show_details_branch_is_not_belongs_to_him()
    {
        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $response = $this->actingAs($adminCustomerUser)->get(
            route('branches.show', ['branch' => $branch->id]));

        $response->assertStatus(403);
    }

    /** @test */
    function admin_customer_user_can_deactivate_branch_is_it_belongs_to_him()
    {
        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => $branch->name,
            'customer_id' => $adminCustomerUser->customer->id,
            'active' => 1
        ]);

        $response = $this->actingAs($adminCustomerUser)->delete(
            route('branches.destroy', ['branch' => $branch->id]));

        $this->assertDatabaseHas('branches', [
            'name' => $branch->name,
            'customer_id' => $adminCustomerUser->customer->id,
            'active' => 0
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('branches.index'));
    }

    /** @test */
    function admin_customer_user_can_not_deactivate_branch_it_is_not_belongs_to_him()
    {
        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $branch = factory(Branch::class)->create();

        $this->assertDatabaseHas('branches', [
            'name' => $branch->name,
            'active' => 1
        ]);

        $response = $this->actingAs($adminCustomerUser)->delete(
            route('branches.destroy', ['branch' => $branch->id]));

        $this->assertDatabaseMissing('branches', [
            'name' => $branch->name,
            'active' => 0
        ]);

        $response->assertStatus(403);

    }

    /** @test */
    function admin_customer_user_check_the_branch_limit()
    {
        $this->withoutExceptionHandling();

        $this->insertRoles();

        $adminCustomerUser = $this->getUserAdminCustomer();

        $this->withoutExceptionHandling();

        $userAdminLimitBranches = $adminCustomerUser->customer->branch_limit;

        $branchesCustomer = factory(Branch::class)->times($userAdminLimitBranches)->create([
            'customer_id' => $adminCustomerUser->customer->id
        ]);

        $branchesOnDb = Branch::where('customer_id', $adminCustomerUser->customer->id)->get();

        $this->assertEquals($branchesCustomer->count(), $branchesOnDb->count());

        $response = $this->actingAs($adminCustomerUser)
            ->get(route('branches.create'));

        $response->assertRedirect(route('branches.index'));
    }

}
