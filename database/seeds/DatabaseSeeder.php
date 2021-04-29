<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Shop
        $this->call(OrderStatusSeeder::class);
        $this->call(VerificationTypeSeeder::class);
        $this->call(PageSystemSeeder::class);
        $this->call(BannerPositionSeeder::class);

        // Manager
        $this->call(ManagerRoleSeeder::class);
        $this->call(ManagerSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
