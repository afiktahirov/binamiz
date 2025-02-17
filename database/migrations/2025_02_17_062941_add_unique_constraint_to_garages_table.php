<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->unique(['company_id', 'complex_id', 'building_id', 'garage_number'], 'unique_garage_per_building');
        });
    }

    public function down()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->dropUnique('unique_garage_per_building');
        });
    }
};
