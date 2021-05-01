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
            'hru' => 'first',
            'name' => 'Основная категория',
            'title' => 'Основная категория',
        ],
        [
            'parent_id' => null,
            'hru' => 'second',
            'name' => 'Второстепенная',
            'title' => 'Дополнительная категория',
        ],
        [
            'parent_id' => null,
            'hru' => 'third',
            'name' => 'Еще третья категория',
            'title' => 'И еще третья категория',
        ],
        [
            'parent_id' => null,
            'hru' => 'fourth',
            'name' => 'Четвертая по счету',
            'title' => 'И еще четвертая категория',
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
