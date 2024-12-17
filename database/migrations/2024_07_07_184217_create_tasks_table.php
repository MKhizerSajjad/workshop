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
            $table->boolean('payment_status')->default(3);
            $table->string('code');
            $table->dateTime('date_opened');
            $table->dateTime('date_service');
            $table->dateTime('date_closed')->nullable();
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->longText('additional_info')->nullable()->comment('additional information about item');
            $table->longText('problem_description')->nullable()->comment('Description of the problem / failure');
            $table->bigInteger('priority_id')->unsigned()->nullable();
            $table->boolean('inspection_diagnose')->default(1)->comment('Inspection and diagnostics fix charges i.e: 35Eur');
            $table->boolean('services_location')->default(1)->comment('where from service get');
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('paid', 10, 2)->nullable();
            $table->decimal('pending', 10, 2)->nullable();
            $table->decimal('service_desired_total', 10, 2)->nullable();
            $table->bigInteger('pickup_point_id')->unsigned()->nullable();
            $table->boolean('is_servised')->nullable();
            $table->boolean('is_satisfied')->nullable();
            $table->text('details');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('technician_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('priority_id')->references('id')->on('priorities')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pickup_point_id')->references('id')->on('pickup_points')->onUpdate('CASCADE')->onDelete('CASCADE');
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
