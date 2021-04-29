<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $name
 * @property string $instagram_username
 * @property string $photo
 */
class Ambassador extends Model
{
    use HasSorting, HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return string
     */
    public function url(): string
    {
        return "https://instagram.com/{$this->instagram_username}";
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
                ->orWhere('instagram_username', 'LIKE', '%'.request('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }
}
