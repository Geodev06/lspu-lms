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
        Schema::create('setup_activity_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id');
            $table->text('question');
            $table->text('answer')->nullable(1);
            $table->integer('points');
            $table->text('image')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_activity_questions');
    }
};
