<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Scopes\ActiveScope;
use Domain\Shop\Models\Scopes\SystemScope;
use Domain\Shop\Models\Traits\HasActiveState;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $hru
 * @property string $name
 * @property string $title
 * @property string $content
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $system
 * @property boolean $active
 */
class Page extends Model implements HasUrl
{
    use HasActiveState;

    const HOME = 'home';

    const STORES = 'stores';

    const CATALOG = 'catalog';

    const SEARCH = 'search';

    const BASKET = 'basket';

    const AUTH_LOGIN = 'auth.login';

    const AUTH_REGISTER = 'auth.register';

    const AUTH_PASSWORD_RESET = 'auth.password.reset';

    const AUTH_PASSWORD_RECOVERY = 'auth.password.recovery';

    const ACCOUNT_ORDERS_CURRENT = 'account.orders.current';

    const ACCOUNT_ORDERS_HISTORY = 'account.orders.history';

    const ACCOUNT_ORDER = 'account.order';

    const ACCOUNT_SETTINGS_PERSONAL = 'account.settings.personal';

    const ACCOUNT_SETTINGS_SECURITY = 'account.settings.security';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'system' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new SystemScope);
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

        return parent::scopeFilter($builder);
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::page', $this->hru);
    }
}
