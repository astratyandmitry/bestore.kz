<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('baskets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->uuid('session_key')->index()->nullable();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedInteger('count')->default(0);
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
        Schema::dropIfExists('baskets');
    }
}
