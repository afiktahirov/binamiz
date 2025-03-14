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
        Schema::create('financial_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_section_id')->constrained('financial_sections')->onDelete('cascade');
            $table->integer('item_code')->unique()->comment('Maliyyə hesabatının maddə kodu');
            $table->string('name')->comment('Maliyyə maddəsinin adı');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_items');
    }
};
