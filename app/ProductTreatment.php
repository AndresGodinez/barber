<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTreatment extends Model
{
    protected $guarded = [];

    public function treatment():BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
