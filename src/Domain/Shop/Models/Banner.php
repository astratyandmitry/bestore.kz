<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $position_id
 * @property string $title
 * @property string $about
 * @property string $image
 *
 * @property \Domain\Shop\Models\BannerPosition $position
 */
class Banner extends Model
{
    use HasActiveState, HasSorting;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'position_id' => 'integer',
        'active' => 'boolean',
    ];

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
                ->orWhere('about', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(BannerPosition::class);
    }
}
