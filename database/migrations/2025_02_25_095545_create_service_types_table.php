<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Xidmət növü adı
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_types');
    }
};
