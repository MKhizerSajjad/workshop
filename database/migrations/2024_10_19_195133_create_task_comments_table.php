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
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('No Action');
            $table->tinyInteger('type')->default(1)->comment('log or comment');
            $table->tinyInteger('visibility')->default(1)->comment('visibility');
            $table->boolean('status')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('No Action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_comments');
    }
};
