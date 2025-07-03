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
        Schema::create('param_learning_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_code');
            $table->text('description');
            $table->string('org_code');
            $table->enum('active_flag', ['Y','N'])->default('Y');

            $table->integer('created_by');
            $table->text('banner')->nullable(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_learning_courses');
    }
};
