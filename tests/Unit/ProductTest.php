<?php

namespace Tests\Unit;

use App\Product;
use App\Category;
use App\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_product_belongs_tRRo_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $product = factory(Product::class)->create([
            'category_id' => $category->id
        ]);

        $this->assertInstanceOf(Category::class, $product->category);
    }

    /** @test */
    function a_product_belongs_to_supplier()
    {
        $this->withoutExceptionHandling();

        $supplier = factory(Supplier::class)->create();

        $product = factory(Product::class)->create([
            'supplier_id' => $supplier->id
        ]);

        $this->assertInstanceOf(Supplier::class, $product->supplier);
    }
}
