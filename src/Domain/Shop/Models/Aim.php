<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $section_id
 * @property string $name
 * @property string $about
 * @property integer|null $product_id_1
 * @property integer|null $product_id_2
 * @property integer|null $product_id_3
 * @property integer|null $product_id_4
 *
 * @property \Domain\Shop\Models\AimSection $section
 * @property \Domain\Shop\Models\Category[] $categories
 */
class Aim extends Model
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
        'section_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(AimSection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyFilter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyFilter = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder->where('name', 'LIKE', '%' . request('info') . '%');
        });

        $builder->when(request('section_id'), function (Builder $builder): Builder {
            return $builder->where('section_id', request('section_id'));
        });

        return parent::scopeFilter($builder, false);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function products(): Collection
    {
        return Catalog::query()->whereIn('id', [
            $this->product_id_1,
            $this->product_id_2,
            $this->product_id_3,
            $this->product_id_4,
        ])->get();
    }
}
