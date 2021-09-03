<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $badge_id
 * @property string $hru
 * @property string $name
 * @property string $image
 * @property integer $price
 * @property integer|null $price_sale
 * @property string|null $composition
 * @property string|null $recommendation
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $active
 * @property integer $count_views
 *
 * @property \Domain\Shop\Models\Category $category
 * @property \Domain\Shop\Models\Brand $brand
 * @property \Domain\Shop\Models\ProductPacking $lowest_price_packing
 * @property \Domain\Shop\Models\ProductPacking[]|\Illuminate\Database\Eloquent\Collection $packing
 * @property \Domain\Shop\Models\ProductTaste[]|\Illuminate\Database\Eloquent\Collection $tastes
 * @property \Domain\Shop\Models\ProductRemain[]|\Illuminate\Database\Eloquent\Collection $remains
 *
 * @method static Builder catalog(?CatalogRequest $request = null)
 */
class Catalog extends Model implements HasUrl
{
    use HasActiveState;

    /**
     * @var string
     */
    protected $table = 'catalog';

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
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Domain\Shop\Requests\CatalogRequest|null $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeCatalog(Builder $builder, ?CatalogRequest $request = null): Builder
    {
        $builder->with('category');

        if (is_null($request)) {
            $request = request();
        }

        $builder->when($request->sort, function (Builder $builder) use ($request): Builder {
            list($column, $type) = explode('.', $request->sort, 2);

            $realColumns = [
                'date' => 'created_at',
                'views' => 'count_views',
                'price' => 'price',
            ];

            $builder->orderBy($realColumns[$column], $type);

            return $builder;
        });

        $builder->when($request->category, function (Builder $builder) use ($request): Builder {
            return $builder->whereIn('category_id', explode(',', $request->category));
        });

        $builder->when($request->brand, function (Builder $builder) use ($request): Builder {
            return $builder->whereIn('brand_id', explode(',', $request->brand));
        });

        $builder->when($request->price_from, function (Builder $builder) use ($request): Builder {
            return $builder->where('price', '>=', (int)$request->price_from);
        });

        $builder->when($request->price_to, function (Builder $builder) use ($request): Builder {
            return $builder->where('price', '<=', (int)$request->price_to);
        });

        $builder->when($request->discount, function (Builder $builder): Builder {
            return $builder->where('price_sale', '>', 0);
        });

        $builder->when($request->query('term'), function (Builder $builder): Builder {
            return $builder->where('name', 'LIKE', '%' . request('term') . '%');
        });

        return $builder;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::product', $this->hru);
    }
}
