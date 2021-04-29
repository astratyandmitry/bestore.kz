<?php

use Domain\Shop\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'hru' => 'almaty',
            'name' => 'Алматы',
            'delivery_price' => 800,
            'free_delivery_min_price' => 12000,
        ],
        [
            'hru' => 'nur-sultan',
            'name' => 'Нур-Сулатн',
            'delivery_price' => 1200,
            'free_delivery_min_price' => 8000,
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        City::query()->truncate();

        foreach ($this->data as $data) {
            $data['active'] = true;

            City::query()->create($data);
        }
    }
}
