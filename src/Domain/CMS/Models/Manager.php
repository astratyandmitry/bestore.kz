<?php

namespace Domain\CMS\Models;

use Domain\Shop\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $role_id
 * @property integer|null $city_id
 * @property string $email
 * @property string $password
 *
 * @property \Domain\CMS\Models\ManagerRole $role
 * @property \Domain\Shop\Models\City $city
 */
class Manager extends Model implements
    \Illuminate\Contracts\Auth\Authenticatable,
    \Illuminate\Contracts\Auth\Access\Authorizable
{
    use \Illuminate\Auth\Authenticatable,
        \Illuminate\Foundation\Auth\Access\Authorizable;

    /**
     * @var array
     */
    protected $guarded = ['old_new_password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $casts = [
        'role_id' => 'integer',
        'city_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(ManagerRole::class, 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
