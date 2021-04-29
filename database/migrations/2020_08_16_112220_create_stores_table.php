<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('city_id')->index();
            $table->string('address', 500);
            $table->string('address_details', 500)->nullable();
            $table->string('phone', 30);
            $table->text('working_hours');
            $table->double('map_latitude');
            $table->double('map_longitude');
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
        Schema::dropIfExists('stores');
    }
}
