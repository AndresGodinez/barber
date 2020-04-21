<?php

/** @var Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Customer::class, function (Faker $faker) {
    $expiration = \Carbon\Carbon::now()->addMonth();
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->email,
        'telephone' => $faker->phoneNumber,
        'expiration' => $expiration,
        'type_id' => function () {
            return factory(\App\Type::class)->create();
        }
    ];
});
