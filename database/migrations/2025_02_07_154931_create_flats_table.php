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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')
                ->constrained('apartments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('block_id')
                ->constrained('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('floor');
            $table->string('number');
            $table->string('size');
            $table->string('fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
