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
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('complex_id')->constrained()->cascadeOnDelete();
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->string('object_number', 255);
            $table->decimal('size', 8, 2);
            $table->enum('status', ['icarədə', 'mülkiyyətdə'])->default('mülkiyyətdə');
            $table->boolean('has_extract')->default(0);
            $table->string('registration_number')->nullable();
            $table->string('registry_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->enum('renter_type', ['owners', 'tenants'])->nullable();
            $table->foreignId('renter_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('tenant_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
};
