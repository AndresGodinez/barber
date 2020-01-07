<?php

namespace App;

use App\Http\Requests\UnitRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function createUnit(UnitRequest $request): Unit
    {
        $this->name = $request->get('name');
        $this->sat_code = $request->get('sat_code');
        $this->ml = $request->get('ml');
        $this->sale_piece = $request->get('sale_piece') == 'on' ? 1 : 0;
        $this->save();
        return $this;
    }
}
