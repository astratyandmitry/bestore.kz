<?php

use Domain\Shop\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'key' => 'created',
            'name' => 'Создан',
        ],
        [
            'key' => 'completed',
            'name' => 'Выполнен',
        ],
        [
            'key' => 'canceled',
            'name' => 'Отменен',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        OrderStatus::query()->truncate();

        foreach ($this->data as $data) {
            OrderStatus::query()->create($data);
        }
    }
}
