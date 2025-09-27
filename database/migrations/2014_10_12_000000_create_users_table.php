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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('control_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable(1);
            $table->string('last_name');
            $table->string('name_ext')->nullable(1);
            $table->string('org_code');
            $table->string('role');
            $table->text('profile')->nullable(1);
            $table->enum('sex',['M','F']);
            $table->integer('section_id');
            $table->integer('active_flag')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('exam_mode')->default(0);
            $table->integer('first_login')->default(1);
            $table->string('preferred_modality')->nullable(1);



            $table->rememberToken();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
