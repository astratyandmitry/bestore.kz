<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $order_id
 * @property integer $city_id
 * @property integer $product_id
 * @property integer $packing_id
 * @property integer $taste_id
 * @property integer $price
 * @property integer $count
 * @property integer $total
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\Packing $packing
 * @property \Domain\Shop\Models\Taste $taste
 */
class OrderItem extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'city_id' => 'integer',
        'product_id' => 'integer',
        'packing_id' => 'integer',
        'taste_id' => 'integer',
        'price' => 'integer',
        'count' => 'integer',
        'total' => 'integer',
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
    public function taste(): BelongsTo
    {
        return $this->belongsTo(Taste::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function packing(): BelongsTo
    {
        return $this->belongsTo(Packing::class);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return "{$this->product->name} {$this->packing->name} ({$this->taste->name})";
    }
}
