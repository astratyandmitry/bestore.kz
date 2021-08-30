<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $name
 * @property string $address
 * @property string $phone
 */
class City extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

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
                ->orWhere('phone', 'LIKE', '%' . request()->get('info') . '%')
                ->orWhere('address', 'LIKE', '%' . request()->get('info') . '%');
        });

        return parent::scopeFilter($builder, $applyOrder);
    }
}
