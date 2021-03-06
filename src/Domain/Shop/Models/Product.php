<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Requests\CatalogRequest;
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
 * @property string|null $badges
 * @property double $rating
 * @property integer $price
 * @property integer|null $price_sale
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $active
 * @property integer $count_views
 *
 * @property \Domain\Shop\Models\Category $category
 * @property \Domain\Shop\Models\Brand $brand
 * @property \Domain\Shop\Models\Review[]|\Illuminate\Database\Eloquent\Collection $reviews
 * @property \Domain\Shop\Models\ProductPacking[]|\Illuminate\Database\Eloquent\Collection $packing
 * @property \Domain\Shop\Models\ProductTaste[]|\Illuminate\Database\Eloquent\Collection $tastes
 * @property \Domain\Shop\Models\ProductRemain[]|\Illuminate\Database\Eloquent\Collection $remains
 * @property \Domain\Shop\Models\ProductStock[]|\Illuminate\Database\Eloquent\Collection $stocks
 *
 * @method static Builder filter(?CatalogRequest $request = null)
 */
class Product extends Model implements HasUrl
{
    use HasActiveState;

    /**
     * @var array
     */
    protected $guarded = ['packing', 'tastes', 'remains'];

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
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('active', true)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function related(): HasMany
    {
        return $this->hasMany(Catalog::class, 'category_id', 'category_id')->where('id', '!=', $this->id)->limit(4);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packing(): HasMany
    {
        return $this->hasMany(ProductPacking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tastes(): HasMany
    {
        return $this->hasMany(ProductTaste::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function remains(): HasMany
    {
        return $this->hasMany(ProductRemain::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class)
            ->where('city_id', Session::get('shop.city_id'))
            ->where('quantity', '>', 0)
            ->orderByRaw(DB::raw('price_sale desc'));
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
     * @param \Domain\Shop\Requests\CatalogRequest|null $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeCatalog(Builder $builder, ?CatalogRequest $request = null): Builder
    {
        if (is_null($request)) {
            $request = request();
        }

        $builder->when($request->sort, function (Builder $builder) use ($request): Builder {
            [$column, $type] = explode('.', $request->sort, 2);

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
            return $builder->where('name', 'LIKE', '%' . request()->get('term') . '%');
        });

        return $builder;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%' . request()->get('info') . '%')
                ->orWhere('hru', 'LIKE', '%' . request()->get('info') . '%');
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
        return (int)($this->price_sale ?: $this->price);
    }

    /**
     *
     */
    public function recalculateRating(): void
    {
        $this->update([
            'rating' => number_format((float)$this->reviews->avg('rating'), 1, '.', ''),
        ]);
    }
}
