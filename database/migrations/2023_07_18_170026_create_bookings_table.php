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
        Schema::create('bookings', function(Blueprint $table){
            $table->id();
            $table->integer('appartmentId')->reference('id')->on('appartments');
            $table->integer('orderId')->reference('id')->on('orders');
            $table->date('bookingFirst');
            $table->date('bookingLast');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
