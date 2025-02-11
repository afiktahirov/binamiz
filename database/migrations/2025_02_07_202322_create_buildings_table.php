<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); // Kompleksə bağlı
            $table->string('name'); // Bina adı
            $table->integer('block_count')->default(1); // Blok sayı
            $table->integer('garage_count')->default(0); // Qaraj sayı
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buildings');
    }
};

