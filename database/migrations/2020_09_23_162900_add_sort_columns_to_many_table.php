<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSortColumnsToManyTable extends Migration
{
    /**
     * @var array
     */
    protected $tables = [
        'ambassadors',
        'categories',
        'cities',
        'stores',
        'brands',
        'aims',
        'aim_sections',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table): void {
                $columns = DB::getSchemaBuilder()->getColumnListing($table->getTable());
                $afterColumn = $columns[count($columns) - 2];

                $table->integer('sort')->default(0)->after($afterColumn);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table): void {
                $table->dropColumn('sort');
            });
        }
    }
}
