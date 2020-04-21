<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Treatment
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductTreatment[] $productTreatments
 * @property-read int|null $product_treatments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property int $branch_id
 * @property float $cost
 * @property float $price
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Treatment whereUserId($value)
 */
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
