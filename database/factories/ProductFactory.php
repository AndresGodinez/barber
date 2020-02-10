<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->word . $faker->postcode,
        'cost' => $cost = $faker->numberBetween(12, 100),
        'sale_price' => $cost * $faker->numberBetween(20, 100),
        'active' => $faker->numberBetween(0, 1),
        'supplier_id' => function () {
            return factory(\App\Supplier::class)->create();
        },
        'category_id' => function () {
            return factory(\App\Category::class);
        }
    ];
});
