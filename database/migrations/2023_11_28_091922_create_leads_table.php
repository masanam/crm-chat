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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('dealer_id');
            $table->string('client_name');
            $table->string('location');
            $table->string('phone_number');
            $table->string('interest');
            $table->integer('progress');
            $table->integer('payment_method');
            $table->integer('budget');
            $table->string('need_car');
            $table->string('notes');
            $table->string('showroom_handler');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
