<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'months' => rand(1,4),
        'price' => $faker->randomFloat(2, 100, 400),
        'discount_percent' => $faker->randomNumber(3),
    ];
});
