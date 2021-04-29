<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('brand_id')->index()->nullable();
            $table->unsignedInteger('badge_id')->index()->nullable();
            $table->string('hru', 80)->unique()->index();
            $table->string('name', 120)->unique();
            $table->string('image', 500);
            $table->text('composition')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('products');
    }
}
