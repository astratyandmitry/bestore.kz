<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        // Shop
        $this->call(CitySeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(VerificationTypeSeeder::class);

        // Manager
        $this->call(ManagerRoleSeeder::class);
        $this->call(ManagerSeeder::class);
    }
}
