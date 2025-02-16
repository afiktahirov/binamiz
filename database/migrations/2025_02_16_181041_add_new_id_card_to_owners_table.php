<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->boolean('new_id_card')->default(false)->after('id_number'); // Yeni Vəsiqə (Checkbox)
        });
    }

    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('new_id_card');
        });
    }
};
