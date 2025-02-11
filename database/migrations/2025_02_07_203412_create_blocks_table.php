<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); // Kompleksə bağlı
            $table->foreignId('building_id')->constrained()->onDelete('cascade'); // Binaya bağlı
            $table->integer('block_number')->nullable(); // Blok nömrəsi
            $table->integer('lift_count')->default(0); // Lift sayı
            $table->integer('total_flats')->default(0); // Bina üzrə mənzil sayı
            $table->integer('max_flats_per_block')->default(0); // Blokda maksimal mənzil sayı
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blocks');
    }
};

