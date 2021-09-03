<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $hru
 * @property string $name
 */
class Taste extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $hidden = [
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

        return parent::scopeFilter($builder);
    }
}
