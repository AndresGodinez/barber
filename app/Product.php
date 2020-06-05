<?php

namespace App;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property float $cost
 * @property float $sale_price
 * @property int $can_be_partial
 * @property int $it_is_bought_by_box
 * @property int $pieces_per_box
 * @property int $measure
 * @property int $category_id
 * @property int $supplier_id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @property-read \App\Supplier $supplier
 * @property-read \App\Unit $unit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product name($name = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCanBePartial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereItIsBoughtByBox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePiecesPerBox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

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
        $this->can_be_partial = $request->get('can_be_partial');
        $this->it_is_bought_by_box = $request->get('it_is_bought_by_box');
        $this->pieces_per_box = $request->get('pieces_per_box');
        $this->measure = $request->get('measure');
        $this->category_id = $request->get('category_id');
        $this->supplier_id = $request->get('supplier_id');
        $this->save();
        return $this;
    }

    public function updateProduct(ProductRequest $request): Product
    {
        $this->name = $request->get('name');
        $this->code = $request->get('code');
        $this->cost = $request->get('cost');
        $this->sale_price = $request->get('sale_price');
        $this->can_be_partial = $request->get('can_be_partial');
        $this->it_is_bought_by_box = $request->get('it_is_bought_by_box');
        $this->pieces_per_box = $request->get('pieces_per_box') ?? 1;
        $this->measure = $request->get('measure') ?? 1;
        $this->category_id = $request->get('category_id');
        $this->supplier_id = $request->get('supplier_id');
        $this->save();
        return $this;
    }
}
