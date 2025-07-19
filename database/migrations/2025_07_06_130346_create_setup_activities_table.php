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
        Schema::create('setup_activities', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->integer('course_id');
            $table->integer('module_id');
            $table->string('org_code');
            $table->integer('created_by');
            $table->enum('active_flag', ['Y', 'N'])->default('Y');
            $table->enum('type', ['MC', 'E', 'I', 'HO']);
            $table->text('image')->nullable(true);
            $table->integer('ide_id')->nullable(1);

            $table->integer('k_flag')->default(0);
            $table->integer('a_flag')->default(0);
            $table->integer('v_flag')->default(0);
            $table->integer('r_flag')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_activities');
    }
};
