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
            $table->string('name');
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('task_item_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('No Action');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('No Action');
            $table->foreignId('task_products_id')->nullable()->constrained()->onDelete('No Action');
            $table->decimal('total', 15, 2)->default(0);
            $table->integer('qty')->default(0);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('tax_perc', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_products');
        Schema::dropIfExists('task_item_products');
    }
};
