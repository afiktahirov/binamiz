<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->foreignId('owner_id')->constrained()->onDelete('cascade'); // Mülkiyyətçiyə bağlı
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); // Kompleksə bağlı
            $table->foreignId('building_id')->constrained()->onDelete('cascade'); // Binaya bağlı
            $table->foreignId('block_id')->constrained()->onDelete('cascade'); // Bloka bağlı
            $table->integer('apartment_number'); // Mənzil nömrəsi
            $table->integer('room_count'); // Otaq sayı
            $table->decimal('total_area', 8, 2); // Mənzilin ümumi ölçüsü
            $table->decimal('living_area', 8, 2); // Mənzilin yaşayış sahəsi
            $table->boolean('is_rented')->default(false); // İcarədədir?
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('set null'); // Kirayəçi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};

