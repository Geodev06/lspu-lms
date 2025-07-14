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
        Schema::create('user_activity_submission_details', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_submission_id');
            $table->text('question');
            $table->text('answer');
            $table->text('correct_answer')->nullable(1);
            $table->integer('points')->nullable(1);
            $table->integer('max_points')->nullable(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_submission_details');
    }
};
