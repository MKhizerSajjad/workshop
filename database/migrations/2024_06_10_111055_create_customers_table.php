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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('receive_newsletter')->default(1);
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('status_detail')->nullable();
            $table->foreignId('platform_id')->indexed()->nullable()->constrained()->onDelete('No Action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
