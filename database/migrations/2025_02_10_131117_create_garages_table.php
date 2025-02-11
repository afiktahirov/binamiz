<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); // Kompleksə bağlı
            $table->foreignId('building_id')->constrained()->onDelete('cascade'); // Binaya bağlı
            $table->integer('garage_number')->unique(); // Qaraj nömrəsi (unikal)
            $table->decimal('size', 8, 2); // Ölçüsü (m²)
            $table->enum('status', ['icarədə', 'mülkiyyətdə'])->default('mülkiyyətdə'); // Statusu
            $table->enum('renter_type', ['sakin', 'kənar'])->nullable(); // İcarəçi növü
            $table->unsignedBigInteger('renter_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('garages');
    }
};
