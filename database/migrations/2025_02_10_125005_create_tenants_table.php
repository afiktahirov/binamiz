<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade'); // Şirkətə bağlı
            $table->decimal('balance', 10, 2)->nullable();
            $table->string('full_name')->nullable(); // Adı soyadı ata adı
            $table->tinyInteger('gender')->nullable();
            $table->string('citizenship')->nullable(); // Vətəndaşlığı
            $table->longText('contact_numbers')->nullable(); // Əlaqə nömrələri (JSON formatında saxlanacaq)
            $table->string('id_series')->nullable(); // Seriya
            $table->string('fin_code', 7);
            $table->string('id_number')->nullable(); // Vəsiqə nömrəsi
            $table->tinyInteger('new_id_card')->default(0);
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

