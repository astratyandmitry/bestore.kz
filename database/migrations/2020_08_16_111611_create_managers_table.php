<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('managers', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('role_id')->index();
            $table->unsignedInteger('city_id')->index()->nullable();
            $table->string('email', 80)->unique()->index();
            $table->string('password', 500);
            $table->rememberToken();
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
        Schema::dropIfExists('managers');
    }
}
