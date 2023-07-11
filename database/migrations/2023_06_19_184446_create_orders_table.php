<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.DONE
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('userId')->references('id')->on('users'); 
            $table->integer('statusId')->references('id')->on('statuses');
            $table->integer('appartmentId')->references('id')->on('appartments');
            $table->integer('placementId')->references('id')->on('placements');
            $table->double('totalSum'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
