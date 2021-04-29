<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('status_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->string('client_name', 80);
            $table->string('client_phone', 14);
            $table->string('client_email', 120);
            $table->string('delivery_address', 500);
            $table->integer('delivery_price')->default(0);
            $table->unsignedInteger('total');
            $table->string('comment', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
