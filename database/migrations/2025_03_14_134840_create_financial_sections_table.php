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
        Schema::create('financial_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->nullable(); // Şirkətə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade')->nullable(); // Kompleksə bağlı
            $table->integer('section_code')->unique()->comment('Maliyyə hesabatının bölmə kodu');
            $table->string('name')->comment('Maliyyə bölməsinin adı');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_sections');
    }
};
