<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $badge_id
 * @property string $hru
 * @property string $url
 * @property string $name
 * @property string $image
 * @property string|null $about
 * @property integer $price
 * @property integer|null $price_sale
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $active
 * @property integer $count_views
 *
 * @property \Domain\Shop\Models\Category $category
 * @property \Domain\Shop\Models\Brand $brand
 */
class Product extends Model implements HasUrl
{
    use HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [['packing', 'tastes', 'remains']];

    /**
     * @var array
     */
    protected $appends = ['url'];

    /**
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'brand_id' => 'integer',
        'active' => 'boolean',
        'count_views' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function related(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')
            ->where('id', '!=', $this->id)
            ->limit(4);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request()->get('info').'%');
        });

        $builder->when(request('category_id'), function (Builder $builder): Builder {
            return $builder->where('category_id', request('category_id'));
        });

        $builder->when(request('brand_id'), function (Builder $builder): Builder {
            return $builder->where('brand_id', request('brand_id'));
        });

        return parent::scopeFilter($builder);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return $this->url();
    }

    /**
     * @return void
     */
    public function increaseView(): void
    {
        $this->update(['count_views' => $this->count_views + 1]);
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::product', $this->hru);
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price_sale ?? $this->price;
    }
}
