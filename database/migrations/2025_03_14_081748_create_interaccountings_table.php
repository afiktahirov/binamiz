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
        Schema::create('interaccountings', function (Blueprint $table) {
            $table->id();
            $table->string('debet_account')->comment('Debet hesabı');
            $table->string('credit_account')->comment('Kredit hesabı');
            $table->decimal('amount',10,2)->comment('Məbləö');
            $table->decimal('amount_with_letter',10,2)->comment('Məbləğin sözlə yazılması');
            $table->text('content')->comment('Əməliyyatın məzmunu');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_accounts');
    }
};
