<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $city_id
 * @property integer $packing_id
 * @property integer $taste_id
 * @property integer $quantity
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\City $city
 * @property \Domain\Shop\Models\Packing $packing
 * @property \Domain\Shop\Models\Taste $taste
 */
class ProductRemain extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'city_id' => 'integer',
        'packing_id' => 'integer',
        'taste_id' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
        'product_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function packing(): BelongsTo
    {
        return $this->belongsTo(Packing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taste(): BelongsTo
    {
        return $this->belongsTo(Taste::class);
    }
}
