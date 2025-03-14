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
        Schema::create('accounting_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_account')->comment('Əsas hesab')->nullable();
            $table->string('account_no')->comment('Hesab Maddəsi');
            $table->string('financial_item')->comment('Maliyyə hesabatının bölməsi');
            $table->string('name')->comment('Hesabın adı');
            $table->string('analytical_code')->nullable()->comment('Analitik uçot şifri')->nullable();
            $table->string('purpose_code')->nullable()->comment('Məqsədli təyinat şifri')->nullable();
            $table->tinyInteger('status')->comment('0-Deaktiv, 1-Aktiv, 2-Aktiv-Deaktiv');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
