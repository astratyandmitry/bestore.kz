<?php

use Domain\Shop\Models\AimSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTitleColumnToAimSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('aim_sections', function (Blueprint $table): void {
            $table->string('title', 200)->after('name');
        });

        AimSection::query()->update(['title' => DB::raw('name')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('aim_sections', function (Blueprint $table): void {
            $table->dropColumn('title');
        });
    }
}
