<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch():BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function scopeOnlyBelongsToCustomer(Builder $query, User $user): Builder
    {
        return $user->isCustomer()
            ? $query->where('customer_id', $user->customer->id)
            : $query;
    }

    public function scopeName(Builder $query, string $name = null): Builder
    {
        return !is_null($name)
            ? $query->where('name', 'like', "%$name%")
            : $query;
    }


}
