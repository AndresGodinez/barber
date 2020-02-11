<?php

namespace Tests\Unit;

use App\Product;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
   /** @test */
   function a_category_has_many_products()
   {
       $category = factory(Category::class)->create();

       factory(Product::class,2)->create([
           'category_id' => $category->id
       ]);

       $this->assertInstanceOf(Product::class, $category->products->first());

   }
}
