<?php

use Domain\Shop\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'parent_id' => null,
            'hru' => 'parent-single',
            'name' => 'Основная',
            'title' => 'Основная категория',
        ],
        [
            'parent_id' => null,
            'hru' => 'parent-child',
            'name' => 'С дочерними',
            'title' => 'Категория с дочерними',
        ],
        [
            'parent_id' => 2,
            'hru' => 'child-1',
            'name' => 'Дочерняя один',
            'title' => 'Дочерняя один категория',
        ],
        [
            'parent_id' => 2,
            'hru' => 'child-2',
            'name' => 'Вторая дочерняя',
            'title' => 'Вторая дочерняя категория',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Category::query()->truncate();

        foreach ($this->data as $index => $data) {
            $data['image'] = "/images/categories/{$data['hru']}.jpeg";
            $data['active'] = true;
            $data['sort'] = $index;

            Category::query()->create($data);
        }
    }
}
