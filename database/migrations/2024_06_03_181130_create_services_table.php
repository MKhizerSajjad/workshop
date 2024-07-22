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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('status')->default(1);
			$table->integer('sort_order')->nullable();
            $table->string('name');
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('tax', 5, 2)->nullable();
            $table->string('time', 100);
            $table->string('picture')->nullable();
            $table->boolean('show_price')->default(1);
            $table->boolean('prioritized')->default(1)->comment('to show in main');
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
