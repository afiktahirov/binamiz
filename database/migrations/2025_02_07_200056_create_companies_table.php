<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Şirkətin adı
            $table->string('logo');
            $table->string('legal_name')->nullable(); // Hüquqi ad
            $table->string('legal_address')->nullable(); // Hüquqi ünvan
            $table->string('taxpayer_id')->nullable(); // VÖEN
            $table->string('registration_number')->nullable(); // Qeydiyyat nömrəsi
            $table->date('registration_date')->nullable(); // Qeydiyyat tarixi
            $table->string('legal_form')->nullable(); // Hüquqi forma

            // Bank Məlumatları
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('correspondent_account')->nullable();

            // Əlaqə Məlumatları
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // İdarəetmə
            $table->string('executive_person')->nullable(); // Direktor və ya icraçı şəxs

            // Lisenziyalar və Sertifikatlar
            $table->string('license_number')->nullable();
            $table->date('license_date')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
