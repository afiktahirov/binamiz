<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('complex_id')->constrained()->onDelete('cascade');
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->integer('garage_number')->unique();
            $table->decimal('size', 8, 2);
            $table->enum('status', ['icarədə', 'mülkiyyətdə'])->default('mülkiyyətdə');
            $table->enum('renter_type', ['owners', 'tenants'])->nullable();
            $table->unsignedBigInteger('renter_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('garages');
    }
};
