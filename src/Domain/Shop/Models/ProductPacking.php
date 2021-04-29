<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $packing_id
 * @property integer $price
 * @property integer|null $price_sale
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\Packing $packing
 */
class ProductPacking extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_packing';

    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'packing_id' => 'integer',
        'price' => 'integer',
        'price_sale' => 'integer',
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
    public function packing(): BelongsTo
    {
        return $this->belongsTo(Packing::class);
    }
}
