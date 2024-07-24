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
        Schema::create('task_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('No Action');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('No Action');
            $table->foreignId('task_products_id')->nullable()->constrained()->onDelete('No Action');
            $table->string('name');
            $table->integer('qty');
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('tax_perc', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_products');
    }
};
