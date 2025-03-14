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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comunal_id')->constrained('comunals')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('calculated_amount')->comment('Hesablanan mebleg');
            $table->decimal('discount_amount')->comment('Guzesht meblegi');
            $table->decimal('discount_percent')->comment('Guzesht faizi');
            $table->decimal('total_amount')->comment('Odenmeli meblegi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
