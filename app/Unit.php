<?php

namespace App;

use App\Http\Requests\UnitRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Unit
 *
 * @property int $id
 * @property string $name
 * @property string|null $sat_code
 * @property float $ml
 * @property int $sale_piece
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereMl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereSalePiece($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereSatCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
