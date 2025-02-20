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
        Schema::table('nova_settings', function (Blueprint $table) {
            $table->json('registration_numbers')->nullable(); // JSON formatında saxlanacaq
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nova_settings', function (Blueprint $table) {
            $table->dropColumn('registration_numbers');
        });
    }
};
