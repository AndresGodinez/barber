<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    protected $guarded = [];

    public function user():HasOne
    {
        return $this->hasOne(User::class);
    }
}
