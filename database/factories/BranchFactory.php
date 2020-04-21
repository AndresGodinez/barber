<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'rfc' => $faker->word . $faker->postcode,
        'telephone' => $faker->phoneNumber
    ];
});
