<?php

namespace Tests\Feature\Http\Controllers;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function user_can_show_form_to_create_a_product()
    {
        $this->withoutExceptionHandling();

        $products = factory(Product::class)->times(10)->create();

        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertViewIs('products.index');

        foreach ($products as $product) {
            $response->assertSee($product->name);
        }
    }

    /** @test */
    function user_can_see_form_to_create_product()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->get(route('products.create'));
        $response->assertStatus(200);
        $response->assertViewIs('products.create');
        $response->assertSee('Nombre');
        $response->assertSee('Costo');
        $response->assertSee('Precio Venta');
        $response->assertSee('Código Interno');
        $response->assertSee('Guardar');
    }

    /** @test */
    function user_can_see_form_to_edit_product()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();
        $product = factory(Product::class)->create();
        $response = $this->actingAs($user)->get(route('products.edit', ['product' => $product->id]));
        $response->assertViewIs('products.edit');
        $response->assertSee('Nombre');
        $response->assertSee($product->name);
        $response->assertSee('Costo');
        $response->assertSee($product->cost);
        $response->assertSee('Precio Venta');
        $response->assertSee($product->sale_price);
        $response->assertSee('Código Interno');
        $response->assertSee($product->code);
        $response->assertSee('Actualizar');
    }

    /** @test */
    function user_can_store_new_product()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->post(route('products.store'), [
            'name' => $name = $this->faker->name,
            'code' => $code = $this->faker->name . $this->faker->postcode,
            'cost' => $cost = $this->faker->numberBetween(30, 100),
            'sale_price' => $salePrice = $cost * $this->faker->numberBetween(20, 100)
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $name,
            'code' => $code,
            'cost' => $cost,
            'sale_price' => $salePrice
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }

    /** @test */
    function user_can_update_product()
    {
        $user = $this->getDefaultUser();

        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)
            ->put(route('products.update', ['product' => $product->id]), [
                'name' => $name = $this->faker->name,
                'code' => $code = $this->faker->word . $this->faker->postcode,
                'cost' => $cost = $product->cost,
                'sale_price' => $salePrice = $product->sale_price
            ]);

        $this->assertDatabaseHas('products', [
            'name' => $name,
            'code' => $code,
            'cost' => $cost,
            'sale_price' => $salePrice
        ]);

    }

    /** @test */
    function user_cant_create_a_product_with_the_same_code()
    {
        $user = $this->getDefaultUser();

        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)
            ->post(route('products.store'), [
                'name' => $product->name,
                'code' => $product->code,
                'cost' => $product->cost,
                'sale_price' => $product->sale_price
            ]);

        $response->assertSessionHasErrors('code');

    }

    /** @test */
    function user_can_show_product_info()
    {
        $user = $this->getDefaultUser();

        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)->get(route('products.show', ['product' => $product->id]));

        $response->assertViewIs('products.show');
    }

}
