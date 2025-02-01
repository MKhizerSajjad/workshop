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
        Schema::create('task_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('No Action');
            $table->boolean('status')->default(1);
            $table->tinyInteger('type')->default(1)->comment('like : priority or inspection&diagnose');
            $table->bigInteger('priority_id')->unsigned()->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('tax_perc', 15, 2)->default(0);
            $table->boolean('customer_choice')->default(2);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_addons');
    }
};
