<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function user_can_get_all_products()
    {
        $this->withoutExceptionHandling();

        $products = factory(Product::class)->times(5)->create();
        $lastProduct = factory(Product::class)->create();

        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->get('api/get-products');

        $response->assertJsonStructure([
            'current_page', 'data', 'first_page_url', 'from', 'last_page', 'last_page_url', 'total'
        ]);

        $this->assertEquals(
            $response->json('data.0.id'),
            $lastProduct->id
        );
    }
}
