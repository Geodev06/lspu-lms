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
        Schema::create('user_activity_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id');

            $table->text('course_name');
            $table->text('module_name');

            $table->text('activity_name');
            $table->text('activity_desc');
            
            $table->string('activity_type');

            $table->decimal('points', 10, 2)->nullable(1)->default(0.0);
            $table->decimal('grade', 10, 2)->nullable(1)->default(0.0);

            $table->integer('checked_flag')->default(1);

            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_submissions');
    }
};
