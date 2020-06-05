<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => 'Andres',
            'username' => 'agodinez',
            'email' => 'ing.a.godienz@gmail.com',
            'customer_id' => null
        ]);

        factory(\App\User::class)->create([
            'name' => 'CustomerAdmin',
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'customer_id' => function(){
                return factory(\App\Customer::class)->create();
            }
        ]);
    }
}
