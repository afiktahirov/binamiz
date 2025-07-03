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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->boolean('blacklist')->default(false); // Qara siyahı
            $table->foreignId('building_id')->nullable()->constrained()->onDelete('set null'); // Bina
            $table->foreignId('apartment_id')->nullable()->constrained()->onDelete('set null'); // Mənzil
            $table->integer('region_number'); // Region nömrəsi
            $table->string('first_letter'); // Birinci hərf
            $table->string('second_letter'); // İkinci hərf
            $table->string('plate_number')->unique(); // Nömrə
            $table->json('contact_numbers')->nullable(); // Telefonlar (JSON formatında saxlanacaq)
            // $table->string('status'); // Statusu (Dropdown)
            $table->boolean('is_active')->default(true); // Aktivlik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
