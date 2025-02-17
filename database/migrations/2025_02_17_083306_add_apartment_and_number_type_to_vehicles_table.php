<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {

            $table->enum('number_type', ['yerli', 'xarici'])->default('yerli'); // Nömrə tipi (Xarici/Yerli)
            $table->string('foreign_number', 15)->nullable(); // Xarici nömrə
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['apartment_id', 'number_type', 'foreign_number']);
        });
    }
};

