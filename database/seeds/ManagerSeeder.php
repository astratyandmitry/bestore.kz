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
            'city_id' => null,
            'email' => 'astratyandmitry@gmail.com',
            'password' => 'aveego',
        ],
        [
            'role_id' => ManagerRole::ADMIN,
            'city_id' => null,
            'email' => 'admin@geneticlab.com',
            'password' => 'admin',
        ],
        [
            'role_id' => ManagerRole::ADMIN,
            'city_id' => 1,
            'email' => 'manager.almaty@geneticlab.com',
            'password' => 'manager',
        ],
        [
            'role_id' => ManagerRole::ADMIN,
            'city_id' => 2,
            'email' => 'manager.nur-sultan@geneticlab.com',
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
