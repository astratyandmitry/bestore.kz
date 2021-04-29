<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $aim_id
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\Aim $packing
 */
class ProductAim extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'aim_id' => 'integer',
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
    public function aim(): BelongsTo
    {
        return $this->belongsTo(Aim::class);
    }
}
