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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->string('code');
            $table->dateTime('date_opened');
            $table->dateTime('date_closed')->nullable();
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('additional_info')->nullable()->comment('additional information about item');
            $table->string('problem_description')->nullable()->comment('Description of the problem / failure');
            $table->boolean('inspection_diagnose')->default(false)->comment('Inspection and diagnostics fix charges i.e: 35Eur');
            $table->boolean('without_diagnose')->default(false)->comment('Repair, according to the problem named and described by the customer. Without diagnostics');
            $table->boolean('priority_id')->nullable(1);  // case_priorities table
            // $table->foreignId('technician_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('details');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('technician_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
