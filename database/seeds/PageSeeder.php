<?php

use Domain\Shop\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'name' => 'О компании',
            'hru' => 'about',
        ],
        [
            'name' => 'Контактная информация',
            'hru' => 'contacts',
        ],
        [
            'name' => 'Адреса магазинов',
            'hru' => 'stores',
        ],
        [
            'name' => 'Оплата товаров',
            'hru' => 'payment',
        ],
        [
            'name' => 'Способы доставки',
            'hru' => 'delivery',
        ],
        [
            'name' => 'Пользовательское соглашение',
            'hru' => 'agreement',
        ],
        [
            'name' => 'Правила пользования сайтом',
            'hru' => 'rules',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Page::query()->where('system', false)->delete();

        foreach ($this->data as $data) {
            $data['active'] = true;
            $data['title'] = $data['name'];
            $data['content'] = '<p>Et nesciunt nihil eveniet voluptatibus saepe quod ea doloremque. Architecto et minima officiis dignissimos corrupti odit. Sed natus nulla harum nulla repellat. Reiciendis ut quis omnis placeat impedit nostrum error.</p><p>Excepturi deserunt repudiandae consectetur in architecto. Quibusdam porro odio eaque. Ut consectetur necessitatibus assumenda.</p><p>Recusandae velit ut est consectetur nam. Quo odit magni consequatur a provident. Dolorem maxime nam et ratione sint rem unde. Tenetur quidem eligendi inventore eligendi pariatur voluptas odit.</p>';

            Page::query()->create($data);
        }
    }
}