<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->unique(
                ['company_id', 'complex_id', 'block_id','building_id', 'apartment_number'],
                'apartments_company_complex_block_apartment_unique'
            );
        });
    }

    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropUnique('apartments_company_complex_block_apartment_unique');
        });
    }
};
