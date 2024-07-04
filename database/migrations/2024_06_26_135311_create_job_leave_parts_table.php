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
        Schema::create('job_leave_parts', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('job_id')->constrained()->onDelete('cascade');
            // $table->foreignId('part_id')->constrained()->onDelete('cascade');
            $table->bigInteger('job_id')->nullable();
            $table->bigInteger('part_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_leave_parts');
    }
};
