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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('item_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            // $table->tinyInteger('status')->default(1);
            // $table->string('name');
            // $table->decimal('price', 15, 2)->nullable();
            // $table->decimal('tax', 5, 2)->nullable();
            // $table->text('detail');
            // $table->timestamps();

            $table->tinyInteger('status')->default(1);
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('wc_id')->nullable()->comment('wocommerece ID');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->string('sku')->nullable();
            $table->boolean('on_sale')->default(false);
            $table->boolean('purchasable')->default(true);
            $table->integer('total_sales')->default(0);
            $table->boolean('virtual')->default(false);
            $table->boolean('downloadable')->default(false);
            $table->boolean('manage_stock')->default(false);
            $table->integer('stock_quantity')->default(0);
            $table->longText('img_url')->nullable();
            $table->string('stock_status')->default('outofstock');
            $table->boolean('backorders_allowed')->default(false);
            $table->boolean('sold_individually')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
