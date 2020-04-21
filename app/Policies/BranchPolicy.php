<?php

namespace App\Policies;

use App\Branch;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(User $user, Branch $branch)
    {
        return $user->id == $branch->user_id;
    }
}
