<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->unique(['company_id', 'complex_id','building_id', 'block_number']);
        });
    }

    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropUnique(['company_id', 'complex_id','building_id', 'block_number']);
        });
    }
};
