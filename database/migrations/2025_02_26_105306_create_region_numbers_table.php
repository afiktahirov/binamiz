<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('region_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('region_number')->unique();
            $table->string('region_name'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('region_numbers');
    }
};
