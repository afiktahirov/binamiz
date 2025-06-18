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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Sorğunun adı
            $table->enum('target_user_type', ['owner', 'tenant', 'all']);
            $table->timestamp('expires_at'); // Son iştirak tarixi
            $table->timestamps(); // created_at (əlavə edilmə tarixi) və updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
