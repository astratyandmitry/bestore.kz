<?php

namespace Domain\Shop\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer|null $user_id
 * @property string|null $session_key
 * @property integer $city_id
 * @property integer $product_id
 * @property integer $packing_id
 * @property integer $taste_id
 * @property integer $count
 * @property integer $total
 *
 * @property \Domain\Shop\Models\ProductStock $stock
 */
class Basket extends Model
{
    use Compoships;

    /**
     * @var array
     */
    protected $guarded = [
        'total',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'city_id' => 'integer',
        'product_id' => 'integer',
        'packing_id' => 'integer',
        'taste_id' => 'integer',
        'count' => 'integer',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
        'session_key',
        'city_id',
        'product_id',
        'taste_id',
        'packing_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $appends = ['total'];

    /**
     *
     * @return int
     */
    public function getTotalAttribute(): int
    {
        return $this->stock->price() * $this->count;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock(): BelongsTo
    {
        $relationColumns = ['city_id', 'product_id', 'packing_id', 'taste_id'];

        return $this->belongsTo(ProductStock::class, $relationColumns, $relationColumns);
    }
}
