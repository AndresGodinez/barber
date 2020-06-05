<?php

namespace App\Observers;

use App\customer;
use App\User;
use App\Utils\StringUtils;

class CustomerObserver
{
    /**
     * Handle the customer "created" event.
     *
     * @param \App\customer $customer
     * @return void
     */
    public function created(customer $customer)
    {
        $name = $customer->name;

        $lasName = $customer->last_name;

        $username = StringUtils::getUserName($name, $lasName);

        $fullName = StringUtils::getFullName($name, $lasName);

        $customerUser = User::create([
            'name' => $fullName,
            'username' => $username,
            'email' => $customer->email,
            'password' => \Hash::make($customer->telephone),
        ]);

        $customerUser->assignRole('customer_admin');
    }
}
