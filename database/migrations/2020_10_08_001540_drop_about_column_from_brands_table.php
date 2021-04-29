<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAboutColumnFromBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table): void {
            $table->dropColumn('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) : void{
            $table->string('about', 500)->after('name')->nullable();
        });
    }
}
