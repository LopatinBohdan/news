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
        Schema::create('appartment_comfort', function (Blueprint $table) {
            $table->id();
            $table->integer('appartment_id');
            $table->integer('comfort_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartment_comfort');
    }
};
