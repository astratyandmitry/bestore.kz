<?php

namespace Domain\Shop\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $city_id
 * @property integer $packing_id
 * @property integer $taste_id
 * @property integer $quantity
 * @property integer $price
 * @property integer|null $price_sale
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\City $city
 * @property \Domain\Shop\Models\Packing $packing
 * @property \Domain\Shop\Models\Taste $taste
 */
class ProductStock extends Model
{
    use Compoships;

    /**
     * @var array
     */
    protected $hidden = [
        'city_id',
        'product_id',
        'packing_id',
        'taste_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'city_id' => 'integer',
        'packing_id' => 'integer',
        'taste_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'integer',
        'price_sale' => 'integer',
    ];

    /**
     * @var array
     */
    protected $with = ['product', 'packing', 'taste'];

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price_sale ? $this->price_sale : $this->price;
    }

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
