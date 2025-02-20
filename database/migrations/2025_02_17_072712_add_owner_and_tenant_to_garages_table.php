<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->constrained('owners')->onDelete('set null');
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['tenant_id']);
            $table->dropColumn(['owner_id', 'tenant_id']);
        });
    }
};

