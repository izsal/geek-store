<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('province_id')->references('id')->on('provinces')->cascadeOnDelete();
            $table->foreignId('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->string('invoice');
            $table->string('courier_name');
            $table->string('courier_service');
            $table->string('courier_cost');
            $table->integer('weight');
            $table->text('address');
            $table->bigInteger('grand_total');
            $table->string('reference')->nullable();
            $table->enum('status', array('UNPAID', 'PAID', 'EXPIRED', 'CANCELLED'))->default('UNPAID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
