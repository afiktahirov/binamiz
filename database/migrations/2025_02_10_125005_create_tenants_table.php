<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->string('full_name'); // Adı soyadı ata adı
            $table->string('citizenship'); // Vətəndaşlığı
            $table->json('contact_numbers'); // Əlaqə nömrələri (JSON formatında saxlanacaq)

            // Şəxsiyyət vəsiqəsi məlumatları
            $table->string('id_series')->nullable(); // Seriya
            $table->string('id_number')->nullable(); // Vəsiqə nömrəsi
            $table->date('birth_date')->nullable(); // Doğum tarixi
            $table->string('registration_address')->nullable(); // Qeydiyyat ünvanı
            $table->date('issue_date')->nullable(); // Verilmə tarixi
            $table->string('issuing_authority')->nullable(); // Verən orqan
            $table->date('valid_until')->nullable(); // Etibarlılıq müddəti

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};

