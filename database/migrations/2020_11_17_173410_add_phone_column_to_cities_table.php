<?php

use Domain\Shop\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneColumnToCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table): void {
            $table->string('phone', 14)->after('name');
        });

        City::query()->update(['phone' => '+7(777)7777777']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table): void {
            $table->dropColumn('phone');
        });
    }
}
