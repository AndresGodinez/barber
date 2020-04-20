<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\ProductTreatment
 *
 * @property int $id
 * @property int $product_id
 * @property int $treatment_id
 * @property float $cost
 * @property float $price
 * @property float $profit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @property-read \App\Treatment $treatment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereTreatmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductTreatment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
