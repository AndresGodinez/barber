<?php

namespace App\Observers;

use App\Staff;
use App\User;

class StaffObserver
{

    /**
     * Handle the staff "created" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function created(Staff $staff)
    {
        $userStaff = User::create([
            'username' => $staff->username,
            'name' => $staff->name,
            'email' => $staff->email,
            'password' => \Hash::make('password'),
            'customer_id' => $staff->customer_id,
            'staff_id' => $staff->id
        ]);

        $userStaff->assignRole('customer_staff');
    }

    /**
     * Handle the staff "updated" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function updated(Staff $staff)
    {
        //
    }

    /**
     * Handle the staff "deleted" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function deleted(Staff $staff)
    {
        //
    }

    /**
     * Handle the staff "restored" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function restored(Staff $staff)
    {
        //
    }

    /**
     * Handle the staff "force deleted" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function forceDeleted(Staff $staff)
    {
        //
    }
}
