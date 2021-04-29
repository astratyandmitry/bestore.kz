<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Basket;
use Domain\Shop\Models\ProductStock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class BasketRepository
{
    /**
     * @var string
     */
    private $owner_column;

    /**
     * @var string
     */
    private $owner_value;

    /**
     * @return void
     */
    public function __construct()
    {
        if (auth(SHOP_GUARD)->check()) {
            $this->owner_column = 'user_id';
            $this->owner_value = auth(SHOP_GUARD)->id();
        } else {
            $this->owner_column = 'session_key';
            $this->owner_value = session()->get(SHOP_SESSION_GUEST);
        }
    }

    /**
     * @return array
     */
    public function existsStockKeys(): array
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('count', '>', 0)
            ->whereHas('stock')
            ->select(DB::raw("concat(product_id, '.', packing_id, '.', taste_id) as k, count"))
            ->pluck('count', 'k')->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Basket::query()
            ->with(['stock', 'stock.product', 'stock.taste', 'stock.packing'])
            ->where($this->owner_column, $this->owner_value)
            ->where('count', '>', 0)
            ->whereHas('stock')
            ->get();
    }

    /**
     * @param int $id
     * @return \Domain\Shop\Models\Basket
     */
    public function findById(int $id): Basket
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param \Domain\Shop\Models\ProductStock $stock
     * @return \Domain\Shop\Models\Basket
     */
    public function findByStock(ProductStock $stock): Basket
    {
        return Basket::query()->firstOrCreate([
            $this->owner_column => $this->owner_value,
            'product_id' => $stock->product_id,
            'packing_id' => $stock->packing_id,
            'taste_id' => $stock->taste_id,
        ]);
    }

    /**
     * @param int $id
     * @param int $count
     * @return bool
     */
    public function updateCount(int $id, int $count): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->update(['count' => $count]);
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->delete();
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function migrateFromGuest(int $user_id): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->update([
                'session_key' => null,
                'user_id' => $user_id,
            ]);
    }
}
