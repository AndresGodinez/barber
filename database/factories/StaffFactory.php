<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->email,
        'customer_id' => function () {
            return factory(\App\Customer::class)->create();
        },
        'branch_id' => function () {
            return factory(\App\Branch::class)->create();
        },
        'commission_percent' => $faker->randomNumber(2)
    ];
});
