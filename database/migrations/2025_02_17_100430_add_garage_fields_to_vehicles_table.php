<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('has_garage')->default(false); // Qaraj var seçimi
            $table->foreignId('garage_id')->nullable()->constrained('garages')->onDelete('set null'); 
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['garage_id']);
            $table->dropColumn(['has_garage', 'garage_id']);
        });
    }
};

