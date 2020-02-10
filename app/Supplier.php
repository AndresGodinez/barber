<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
