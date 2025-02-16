<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->boolean('has_extract')->default(false)->after('status'); 
            $table->string('registration_number')->nullable()->after('has_extract'); 
            $table->string('registry_number')->nullable()->after('registration_number'); 
            $table->date('issue_date')->nullable()->after('registry_number'); 
        });
    }

    public function down()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->dropColumn(['has_extract', 'registration_number', 'registry_number', 'issue_date']);
        });
    }
};
