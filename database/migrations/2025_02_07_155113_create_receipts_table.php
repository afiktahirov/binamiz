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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residence_id')
                ->constrained('residences')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('amount',10,2)->default(0);
            $table->float('debt',10,2)->default(0);
            $table->enum('status',['Ödənilib','Ödənilməyib','Gecikib'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
