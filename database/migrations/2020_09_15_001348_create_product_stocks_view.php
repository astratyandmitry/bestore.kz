<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW product_stocks AS
                        SELECT 
                            product_remains.city_id,
                            product_remains.product_id,
                            product_remains.packing_id,
                            product_remains.taste_id,
                            product_remains.quantity,
                            product_packing.price,
                            product_packing.price_sale
                            
                            from product_remains
                            
                            left join product_packing on (product_packing.product_id = product_remains.product_id and product_packing.packing_id = product_remains.packing_id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement("DROP VIEW product_stocks");
    }
}
