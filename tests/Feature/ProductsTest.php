<?php

namespace Tests\Feature\Http\Controllers;

use App\Category;
use App\Product;
use App\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function user_can_see_index_products()
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
        $response->assertSee('Categoria');
        $response->assertSee('Proveedor');
        $response->assertSee('Puede ser parcial');
        $response->assertSee('¿Solo puede ser comprado por caja?');
        $response->assertSee('Cantidad de productos por caja');
        $response->assertSee('Presentación');
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

        $response->assertSee('Categoria');
        $response->assertSee($product->category->name);

        $response->assertSee('Proveedor');
        $response->assertSee($product->supplier->name);

        $response->assertSee('Puede ser parcial');
        $response->assertSee($product->can_be_partial);
        $response->assertSee('¿Solo puede ser comprado por caja?');
        $response->assertSee($product->it_is_bought_by_box);
        $response->assertSee('Cantidad de productos por caja');
        $response->assertSee($product->pieces_per_box);

        $response->assertSee('Presentación');

        $response->assertSee($product->measure);

        $response->assertSee('Actualizar');
    }

    /** @test
     * @throws \Exception
     */
    function user_can_store_new_product()
    {
        $this->withoutExceptionHandling();

        $itIstBoughtPerBox = rand(0, 1);
        $canBePartial = rand(0, 1);
        $piecesPerBox = $itIstBoughtPerBox ? random_int(2, 24) : 0;
        $measure = $canBePartial ? random_int(100, 1000) : 0;

        $category = factory(Category::class)->create();
        $supplier = factory(Supplier::class)->create();

        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->post(route('products.store'), [
            'name' => $name = $this->faker->name,
            'code' => $code = $this->faker->name . $this->faker->postcode,
            'cost' => $cost = $this->faker->numberBetween(30, 100),
            'sale_price' => $salePrice = $cost * $this->faker->numberBetween(20, 100),
            'can_be_partial' => $canBePartial,
            'it_is_bought_by_box' => $itIstBoughtPerBox,
            'pieces_per_box' => $piecesPerBox,
            'measure' => $measure,
            'category_id' => $category->id,
            'supplier_id' => $supplier->id
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $name,
            'code' => $code,
            'cost' => $cost,
            'sale_price' => $salePrice,
            'can_be_partial' => $canBePartial,
            'it_is_bought_by_box' => $itIstBoughtPerBox,
            'pieces_per_box' => $piecesPerBox,
            'measure' => $measure,
            'category_id' => $category->id,
            'supplier_id' => $supplier->id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }

    /** @test */
    function user_can_update_product()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();

        $product = factory(Product::class)->create();


        $response = $this->actingAs($user)
            ->put(route('products.update', ['product' => $product->id]), [
                'name' => $name = $this->faker->name,
                'code' => $code = $this->faker->word . $this->faker->postcode,
                'cost' => $cost = $product->cost,
                'sale_price' => $salePrice = $product->sale_price,
                'can_be_partial' => 1,
                'it_is_bought_by_box' => 0,
                'category_id' => $product->category_id,
                'supplier_id' => $product->supplier_id
            ]);

        $this->assertDatabaseHas('products', [
            'name' => $name,
            'code' => $code,
            'cost' => $cost,
            'sale_price' => $salePrice,
            'can_be_partial' => 1,
            'it_is_bought_by_box' => 0,
            'category_id' => $product->category_id,
            'supplier_id' => $product->supplier_id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));

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
