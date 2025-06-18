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
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade');
            $table->foreignId('poll_id')->constrained("polls")->onDelete('cascade');
            $table->foreignId('question_id')->constrained("poll_questions")->onDelete('cascade');
            $table->foreignId('answer_id')->constrained("poll_answers")->onDelete('cascade');
            $table->timestamps();

            // İstifadəçi hər sorğuda 1 dəfə iştirak edə bilsin
            $table->unique(['user_id', 'poll_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};
