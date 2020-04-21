<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MultiTenantTable
{

    public static function bootMultiTenantTable()
    {

        if (auth()->check()) {
            if (auth()->user()->isCustomer()) {
                static::creating(function ($model) {
                    $model->customer_id = auth()->id()->customer->id;
                });

                static::addGlobalScope('customer_id', function (Builder $builder) {
                    return $builder->where('customer_id', auth()->user()->customer->id);
                });
            }
        }

    }

}