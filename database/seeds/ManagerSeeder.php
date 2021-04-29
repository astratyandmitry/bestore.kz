<?php

use Domain\CMS\Models\Manager;
use Domain\CMS\Models\ManagerRole;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'role_id' => ManagerRole::ADMIN,
            'email' => 'astratyandmitry@gmail.com',
            'password' => 'aveego',
        ],
        [
            'role_id' => ManagerRole::ADMIN,
            'email' => 'admin@ura-shop.kz',
            'password' => 'admin',
        ],
        [
            'role_id' => ManagerRole::MANAGER,
            'email' => 'manager@ura-shop.kz',
            'password' => 'manager',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Manager::query()->truncate();

        foreach ($this->data as $data) {
            $data['password'] = bcrypt($data['password']);

            Manager::query()->create($data);
        }
    }
}
