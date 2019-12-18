<?php

namespace App;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeName(Builder $query, string $name = null): Builder
    {
        return !is_null($name)
            ? $query->where('name', 'like', "%$name%")
            : $query;
    }

    public function createNewProduct(ProductRequest $request): Product
    {
        $this->name = $request->get('name');
        $this->code = $request->get('code');
        $this->cost = $request->get('cost');
        $this->sale_price = $request->get('sale_price');
        $this->save();
        return $this;
    }

    public function updateProduct(ProductRequest $request)
    {
        $this->name = $request->get('name');
        $this->code = $request->get('code');
        $this->cost = $request->get('cost');
        $this->sale_price = $request->get('sale_price');
        $this->save();
        return $this;
    }
}
