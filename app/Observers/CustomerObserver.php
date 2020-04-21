<?php

namespace App\Observers;

use App\customer;
use App\User;
use App\Utils\StringUtils;
use Illuminate\Support\Str;

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

        User::create([
            'name' => $fullName,
            'username' => $username,
            'email' => $customer->email,
            'password' => \Hash::make($customer->telephone),
        ]);
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param \App\customer $customer
     * @return void
     */
    public function updated(customer $customer)
    {
        //
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param \App\customer $customer
     * @return void
     */
    public function deleted(customer $customer)
    {
        //
    }

    /**
     * Handle the customer "restored" event.
     *
     * @param \App\customer $customer
     * @return void
     */
    public function restored(customer $customer)
    {
        //
    }

    /**
     * Handle the customer "force deleted" event.
     *
     * @param \App\customer $customer
     * @return void
     */
    public function forceDeleted(customer $customer)
    {
        //
    }
}
