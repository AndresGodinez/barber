<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Trial',
                'months' => 1,
                'price' => 0,
                'discount_percent' => 0
            ],
            [
                'name' => 'Monthly',
                'months' => 1,
                'price' => 500,
                'discount_percent' => 0
            ],
            [
                'name' => 'Quarterly',
                'months' => 3,
                'price' => 1500,
                'discount_percent' => 5
            ],
            [
                'name' => 'Semiannual',
                'months' => 6,
                'price' => 3000,
                'discount_percent' => 10
            ],
            [
                'name' => 'Annual',
                'months' => 12,
                'price' => 6000,
                'discount_percent' => 15
            ],

        ];

        foreach ($plans as $plan){
            $this->insertPlan($plan);
        }
    }

    private function insertPlan($plan)
    {
        \App\Type::create($plan);
    }
}
