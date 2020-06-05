<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'system_admin']);
        Role::create(['name' => 'customer_admin']);
        Role::create(['name' => 'customer_staff']);
    }
}
