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

        DB::unprepared("
            #9/7/2025

            CREATE TABLE `lspu_lms`.`param_survey_question_2` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `question` TEXT NOT NULL,
            `category` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`));
            
            CREATE TABLE `lspu_lms`.`survey_2_results` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `score_visual` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
            `score_auditory` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
            `score_reading` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
            `score_kinesthetic` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
            `final_score` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
            `created_by` VARCHAR(45) NULL,
            `created_at` TIMESTAMP NULL,
            PRIMARY KEY (`id`));


            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('When studying IT concepts, I prefer to use diagrams, charts, or flowcharts.', 'V');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('Watching tutorials or demonstrations helps me understand IT topics better.', 'V');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I remember information better when it is presented visually (e.g., images, videos, graphs).', 'V');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('When taking notes on programming or IT-related material, I color code and highlight them. ', 'V');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I prefer to see written instructions, such as code snippets, supplemented by visual aids such as screenshots.', 'V');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I learn new IT concepts more effectively when they are explained or discussed. ', 'A');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('Listening to technology-related lectures or podcasts allows me to better understand the material. ', 'A');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I enjoy having group discussions or debates about programming languages or IT concepts. ', 'A');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('When I hear IT concepts described aloud, I remember them much better. ', 'A');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('When instructions are narrated by a voice (for example, audio guides), I find it easier to concentrate on learning.', 'A');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I prefer to learn IT concepts from textbooks, manuals, and online resources. ', 'R');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('Writing notes, essays, or summaries helps me understand and retain IT-related information.', 'R');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('Reading step-by-step instructions makes it easier for me to solve programming problems.', 'R');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I prefer to write code or algorithms rather than using drag-and-drop tools. ', 'R');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('For revision, I usually write summaries or notes from my IT courses.', 'R');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I understand IT concepts better when I can put them into practice (for example, coding and network configuration).', 'K');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I learn best by doing projects or developing applications rather than simply reading about them. ', 'K');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I find it difficult to participate in IT learning without firsthand experience or practice. ', 'K');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('I prefer to work on practical tasks (such as coding assignments and server configuration) rather than theoretical tasks. ', 'K');
            INSERT INTO `lspu_lms`.`param_survey_question_2` (`question`, `category`) VALUES ('5.I enjoy working in IT labs, simulations, and real-world scenarios.', 'K');

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
