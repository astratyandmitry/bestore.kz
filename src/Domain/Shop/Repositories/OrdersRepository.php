<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Basket;
use Domain\Shop\Models\Basket as BasketModel;
use Domain\Shop\Models\City;
use Domain\Shop\Models\Order;
use Domain\Shop\Models\OrderItem;
use Domain\Shop\Models\OrderStatus;
use Domain\Shop\Requests\OrderRequest;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class OrdersRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function current()
    {
        return Order::query()->where('status_id', OrderStatus::CREATED)->paginate(12);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function history()
    {
        return Order::query()->where('status_id', '!=', OrderStatus::CREATED)->paginate(12);
    }

    /**
     * @param int $id
     * @return \Domain\Shop\Models\Order
     */
    public function findById(int $id): Order
    {
        return Order::query()->where('id', $id)->with('items')->firstOrFail();
    }

    /**
     * @param int $id
     * @param string|null $uuid
     * @return \Domain\Shop\Models\Order|null
     */
    public function findByUuidAndId(int $id, ?string $uuid = null): ?Order
    {
        return Order::query()
            ->where('uuid', $uuid)
            ->where('id', $id)
            ->first();
    }

    /**
     * @param \Domain\Shop\Requests\OrderRequest $request
     * @param \Domain\Shop\Models\City $city
     * @param \Domain\Shop\Basket $basket
     * @return \Domain\Shop\Models\Order
     */
    public function create(OrderRequest $request, City $city, Basket $basket): Order
    {
        $order = new Order;
        $order->client_name = $request->name;
        $order->client_phone = $request->phone;
        $order->client_email = $request->email;
        $order->delivery_address = $request->address;
        $order->comment = $request->comment;
        $order->delivery_price = $basket->total() < $city->free_delivery_min_price ? $city->delivery_price : 0;
        $order->city_id = $city->id;
        $order->total = $basket->total();
        $order->status_id = OrderStatus::CREATED;

        if ($user_id = auth(SHOP_GUARD)->id()) {
            $order->user_id = $user_id;
        }

        $order->save();

        foreach ($basket->getItems() as $basketItem) {
            $this->addItem($order, $basketItem);
        }

        return $order;
    }

    /**
     * @param \Domain\Shop\Models\Order $order
     * @param \Domain\Shop\Models\Basket $basket
     * @return \Domain\Shop\Models\OrderItem
     */
    public function addItem(Order $order, BasketModel $basket): OrderItem
    {
        return $order->items()->create([
            'product_id' => $basket->product_id,
            'packing_id' => $basket->packing_id,
            'taste_id' => $basket->taste_id,
            'city_id' => $basket->city_id,
            'count' => $basket->count,
            'price' => $basket->stock->price(),
            'total' => $basket->count * $basket->stock->price(),
        ]);
    }

    /**
     * @return \Domain\Shop\Models\Order|null
     */
    public function last(): ?Order
    {
        return Order::query()
            ->whereNotNull('user_id')
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->latest()->first();
    }
}
