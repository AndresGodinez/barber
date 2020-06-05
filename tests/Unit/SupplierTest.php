<?php

namespace Tests\Unit;

use App\Product;
use App\Supplier;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_supplier_has_many_products()
    {
        $supplier = factory(Supplier::class)->create();

        $products = factory(Product::class, 4)->create([
            'supplier_id' => $supplier->id
        ]);

        $this->assertInstanceOf(Product::class, $supplier->products->first());

    }
}
