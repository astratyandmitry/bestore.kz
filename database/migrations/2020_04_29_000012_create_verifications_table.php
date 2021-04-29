<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('type_id')->constrained('verification_types');
            $table->foreignId('user_id')->constrained('users');
            $table->string('code', 12)->index();
            $table->timestamp('expired_at');
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
        Schema::dropIfExists('verifications');
    }
}
