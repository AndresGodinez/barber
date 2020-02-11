<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treatment extends Model
{
    public function product(Product $product)
    {
        $this->productTreatments()->firstOrCreate([
            'treatment_id' => $this->id,
            'product_id' => $product->id
        ]);
    }

    public function productTreatments():HasMany
    {
        return $this->hasMany(ProductTreatment::class);
    }
}
