<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockColumnsToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table): void {
            $table->unsignedInteger('taste_id')->index()->after('order_id');
            $table->unsignedInteger('packing_id')->index()->after('order_id');
            $table->unsignedInteger('product_id')->index()->after('order_id');
            $table->unsignedInteger('city_id')->index()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table): void {
            $table->dropColumn('taste_id');
            $table->dropColumn('packing_id');
            $table->dropColumn('product_id');
            $table->dropColumn('city_id');
        });
    }
}
