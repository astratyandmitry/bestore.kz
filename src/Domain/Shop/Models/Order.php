<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

/**
 * @property string $uuid
 * @property integer $status_id
 * @property integer|null $user_id
 * @property string $client_name
 * @property string $client_phone
 * @property string $client_email
 * @property string $delivery_address
 * @property integer $delivery_price
 * @property integer $total
 * @property string|null $comment
 *
 * @property \Domain\Shop\Models\OrderStatus $status
 * @property \Domain\Shop\Models\User $user
 * @property \Domain\Shop\Models\OrderItem[] $items
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_name',
        'client_phone',
        'client_email',
        'delivery_address',
        'comment',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status_id' => 'integer',
        'user_id' => 'integer',
        'delivery_price' => 'integer',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order): void {
            $order->uuid = Uuid::uuid1()->toString();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('client'), function (Builder $builder): Builder {
            return $builder
                ->where('client_name', 'LIKE', '%'.request()->get('client').'%')
                ->orWhere('client_phone', 'LIKE', '%'.request()->get('client').'%')
                ->orWhere('client_email', 'LIKE', '%'.request()->get('client').'%');
        });

        $builder->when(request('city_id'), function (Builder $builder): Builder {
            return $builder->where('city_id', request('city_id'));
        });

        $builder->when(request('status_id'), function (Builder $builder): Builder {
            return $builder->where('status_id', request('status_id'));
        });

        return parent::scopeFilter($builder);
    }

    /**
     * @param int $status_id
     * @return void
     */
    public function changeStatus(int $status_id): void
    {
        $this->status_id = $status_id;
        $this->save();
    }

    /**
     * @return bool
     */
    public function current(): bool
    {
        return $this->status_id === ORDER_STATUS_CREATED;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::account.order', $this->id);
    }

    /**
     * @return string
     */
    public function detailUrl(): string
    {
        return route('shop::order', [
            'id' => $this->id,
            'uuid' => $this->uuid,
        ]);
    }
}
