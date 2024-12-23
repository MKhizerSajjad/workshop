<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('assigned_ip')->nullable();
            $table->time('hours_start')->nullable();
            $table->time('hours_end')->nullable();
            $table->json('days')->nullable(); // JSON to store allowed working days (e.g., ["Monday", "Tuesday"])

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_controls');
    }
};
