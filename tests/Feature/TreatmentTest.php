<?php

namespace Tests\Feature;

use App\Product;
use App\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_treatment_has_many_products()
    {
        $this->markTestIncomplete();
        $products = factory(Product::class, 3)->create();

        $treatment = factory(Treatment::class)->create();

        foreach ($products as $product) {
            $treatment->product($product);
        }

        $this->assertInstanceOf(Product::class, $treatment->products->first());
    }
}
