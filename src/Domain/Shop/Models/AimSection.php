<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $hru
 * @property string $name
 * @property string $title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 *
 * @property \Domain\Shop\Models\Aim[] $aims
 */
class AimSection extends Model implements HasUrl
{
    use HasSorting, HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aims(): HasMany
    {
        return $this->hasMany(Aim::class, 'section_id');
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
     * @param bool $applyFilter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyFilter = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request('info').'%')
                ->orWhere('title', 'LIKE', '%'.request('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::aim_section', $this->hru);
    }
}
