<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCatalogView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW catalog AS
                        SELECT 
                            products.*,
                            product_packing.price as price,
                            product_packing.price_sale as price_sale
                            
                            FROM products
                            
                            LEFT JOIN product_packing ON (product_packing.id = (
                                SELECT id FROM product_packing WHERE product_id = products.id ORDER BY price ASC LIMIT 1
                            ))
                            
                            WHERE product_packing.price IS NOT NULL AND product_packing.price > 0
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog');
    }
}
