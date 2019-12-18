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

        $response = $this->get('/clients?name='.$name);
        $response->assertStatus(200);
        $response->assertViewIs('clients.index');

        $response->assertSeeText($name);
        $response->assertDontSee($clients->last()->name);

    }


}
