<?php

namespace Domain\Shop\Models;

use Domain\CMS\Models\Traits\Filterable;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $hru
 * @property string $name
 * @property string $phone
 * @property integer $delivery_price
 * @property integer $free_delivery_min_price
 *
 * @property \Domain\Shop\Models\Store[] $stores
 */
class City extends Model
{
    use Filterable, HasSorting, HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'delivery_price' => 'integer',
        'free_delivery_min_price' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'phone',
        'delivery_price',
        'free_delivery_min_price',
        'active',
        'sort',
        'created_at',
        'updated_at',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyFilter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyFilter = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class)->where('active', true);
    }

}
