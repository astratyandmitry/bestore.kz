<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $city_id
 * @property string $address
 * @property string $address_details
 * @property string $phone
 * @property string $working_hours
 * @property string $map_embed
 *
 * @property \Domain\Shop\Models\City $city
 */
class Store extends Model
{
    use HasSorting, HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'city_id' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $hidden = ['city_id', 'created_at', 'updated_at', 'sort', 'active'];

    /**w
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
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
                ->where('address', 'LIKE', '%'.request('info').'%')
                ->orWhere('phone', 'LIKE', '%'.request('info').'%');
        });

        $builder->when(request('city_id'), function (Builder $builder): Builder {
            return $builder->where('city_id', request('city_id'));
        });

        return parent::scopeFilter($builder, false);
    }
}
