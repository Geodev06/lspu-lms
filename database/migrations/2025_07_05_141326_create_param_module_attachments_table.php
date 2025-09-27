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
        Schema::create('param_module_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->text('file_name');
            $table->text('sys_file_name');
            $table->string('category');

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
        Schema::dropIfExists('param_module_attachments');
    }
};
