<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->string('name'); // Kompleksin adı
            $table->string('address')->nullable(); // Kompleksin ünvanı
            $table->decimal('residential_price', 10, 2)->nullable(); // Yaşayış sahələri üzrə kommunal qiymət
            $table->decimal('non_residential_price', 10, 2)->nullable(); // Qeyri-yaşayış sahələri üzrə kommunal qiymət
            $table->decimal('garage_price', 10, 2)->nullable(); // Qaraj sahələri üçün kommunal qiymət
            $table->boolean('garage_is_fixed')->default(false); // Qaraj üçün qiymət sabitdir?
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complexes');
    }
};

