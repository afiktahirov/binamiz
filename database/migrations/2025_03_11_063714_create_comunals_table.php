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
        Schema::create('comunals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); // Kompleksə bağlı
            $table->foreignId('building_id')->constrained()->onDelete('cascade'); // Binaya bağlı
            $table->integer('owner_type');
            $table->integer('owner_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('property_type')->nullable();
            $table->integer('flat_id')->nullable();
            $table->integer('object_id')->nullable();
            $table->integer('garage_id')->nullable();
            $table->integer('has_discount')->default(0);
            $table->integer('discount_percent')->nullable();
            $table->integer('discount_base')->nullable();
            $table->integer('discount_file')->nullable();
            $table->integer('pause')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunals');
    }
};
