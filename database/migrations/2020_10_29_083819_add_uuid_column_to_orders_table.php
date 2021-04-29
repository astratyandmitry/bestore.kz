<?php

use Ramsey\Uuid\Uuid;
use Domain\Shop\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->uuid('uuid')->index()->after('id');
        });

        Order::query()->get()->each(function(Order $order): void {
            $order->uuid = Uuid::uuid1()->toString();
            $order->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) : void{
            $table->dropColumn('uuid');
        });
    }
}
