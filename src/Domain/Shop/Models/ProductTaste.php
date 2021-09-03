<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $taste_id
 *
 * @property \Domain\Shop\Models\Taste $taste
 */
class ProductTaste extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'taste_id' => 'integer',
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
    public function taste(): BelongsTo
    {
        return $this->belongsTo(Taste::class);
    }
}
