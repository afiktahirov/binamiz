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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')
                ->constrained('apartments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('block_id')
                ->constrained('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('flat_id')
                ->constrained('flats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('fullname');
            $table->string('id_number');
            $table->string('id_fin');
            $table->string('note');
            $table->date('issued_date');
            $table->float('debt',10,2)->default(0);
            $table->float('balance',10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residences');
    }
};
