<?php

use App\Enums\ApplicationDepartmentEnum;
use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationTypeEnum;
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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ApplicationTypeEnum::values());
            $table->enum('department', ApplicationDepartmentEnum::values());
            $table->enum('status', ApplicationStatusEnum::values())->default(ApplicationStatusEnum::PENDING->value);
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('viewed_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
