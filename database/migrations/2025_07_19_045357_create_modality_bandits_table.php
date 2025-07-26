<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modality_bandits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('modality');
            $table->unsignedInteger('successes')->default(1); // α
            $table->unsignedInteger('failures')->default(1); // β
            $table->timestamps();
        });


        DB::unprepared("
            #7/26/2025
            ALTER TABLE `lspu_lms`.`setup_question_choices` 
            ADD COLUMN `image` TEXT NULL DEFAULT NULL AFTER `choice`;

            ALTER TABLE `lspu_lms`.`user_activity_submission_details` 
            ADD COLUMN `image` TEXT NULL DEFAULT NULL AFTER `answer`;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modality_bandits');
    }
};
