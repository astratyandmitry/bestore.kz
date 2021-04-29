<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockColumnsToBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('baskets', function (Blueprint $table): void {
            $table->unsignedInteger('taste_id')->index()->after('session_key');
            $table->unsignedInteger('packing_id')->index()->after('session_key');
            $table->unsignedInteger('product_id')->index()->after('session_key');
            $table->unsignedInteger('city_id')->index()->after('session_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('baskets', function (Blueprint $table): void {
            $table->dropColumn('taste_id');
            $table->dropColumn('packing_id');
            $table->dropColumn('product_id');
            $table->dropColumn('city_id');
        });
    }
}
