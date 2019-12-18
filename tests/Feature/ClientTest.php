<?php

namespace Tests\Feature;

use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_see_the_clients_index()
    {
        $this->withoutExceptionHandling();

        $clients = factory(Client::class)->times(5)->create();

        $response = $this->get('/clients');
        $response->assertStatus(200);
        $response->assertViewIs('clients.index');

        foreach ($clients as $client) {
            $response->assertSeeText($client->name);
        }

    }

    public function user_can_find_user_by_name()
    {
        $this->withoutExceptionHandling();

        $clients = factory(Client::class)->times(5)->create();

        $name = $clients->first()->name;

        $response = $this->get('/clients?name=' . $name);
        $response->assertStatus(200);
        $response->assertViewIs('clients.index');

        $response->assertSeeText($name);
        $response->assertDontSee($clients->last()->name);

    }

    /** @test */
    function user_can_see_form_to_create_a_client()
    {
        $response = $this->get('/clients/create');
        $response->assertStatus(200);
        $response->assertViewIs('clients.create');
        $response->assertSee('Nombre');
        $response->assertSee('Teléfono');
        $response->assertSee('Email');
        $response->assertSee('Guardar');
    }

    /** @test */
    function use_can_store_a_new_client()
    {
        $response = $this->post('clients', [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->safeEmail,
            'telephone' => $telephone = $this->faker->phoneNumber,
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => $name,
            'email' => $email,
            'telephone' => $telephone,
        ]);

    }

    /** @test */
    function user_cant_create_user_whit_the_same_email()
    {
        $response = $this->post('clients', [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->safeEmail,
            'telephone' => $telephone = $this->faker->phoneNumber,
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => $name,
            'email' => $email,
            'telephone' => $telephone,
        ]);

        $response2 = $this->post('clients', [
            'name' => $name,
            'email' => $email,
            'telephone' => $telephone,
        ]);

        $response2->assertSessionHasErrors('email');
        $response2->assertSessionHasErrors('telephone');

    }

    /** @test */
    function user_can_show_edit_form_client()
    {
        $clients = factory(Client::class)->times(2)->create();
        $client = $clients->first();
        $response = $this->get(route('clients.edit', ['client' => $client->id]));
        $response->assertStatus(200);
        $response->assertViewIs('clients.edit');
        $response->assertSee('nombre');
        $response->assertSee($client->name);
        $response->assertSee('Teléfono');
        $response->assertSee($client->telephone);
        $response->assertSee('Actualizar');
    }

    /** @test */
    function user_can_update_name_client()
    {
        $this->withoutExceptionHandling();

        $client = factory(Client::class)->create();

        $this->assertDatabaseHas('clients', [
            'name' => $client->name,
            'email' => $client->email,
            'telephone' => $client->telephone,
        ]);

        $response = $this->put(route('clients.update', ['client' => $client->id]), [
            'name' => $name = $this->faker->name,
            'telephone' => $client->telephone,
            'email' => $client->email,
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => $name,
        ]);

        $response->assertRedirect('clients');
    }

    /** @test */
    function user_can_show_inf_client()
    {
        $client = factory(Client::class)->create();
        $response = $this->get(route('clients.show', ['client' => $client->id]));
        $response->assertViewIs('clients.show');
        $response->assertStatus(200);
        $response->assertSee('Nombre');
        $response->assertSee($client->name);
        $response->assertSee('Teléfono');
        $response->assertSee($client->telephone);
        $response->assertSee('Email');
        $response->assertSee($client->email);
    }


}
