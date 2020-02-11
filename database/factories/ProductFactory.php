<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $it_is_bought_by_box = rand(0, 1);

    $canBePartial = rand(0, 1);

    return [
        'name' => $faker->name,
        'code' => $faker->word . $faker->postcode,
        'cost' => $cost = $faker->numberBetween(12, 100),
        'sale_price' => $cost * $faker->numberBetween(20, 100),
        'active' => rand(0, 1),
        'can_be_partial' => $canBePartial,

        'it_is_bought_by_box' => $it_is_bought_by_box,
        'pieces_per_box' => $it_is_bought_by_box ? random_int(2, 24) : 1,
        'measure' => $canBePartial ? random_int(300, 750) : 1,

        'supplier_id' => function () {
            return factory(\App\Supplier::class)->create();
        },
        'category_id' => function () {
            return factory(\App\Category::class);
        }
    ];
});
