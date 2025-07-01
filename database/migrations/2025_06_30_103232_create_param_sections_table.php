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
        Schema::create('param_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->string('org_code');
            $table->string('school_year');
            $table->timestamps();
        });

          DB::unprepared("
            INSERT INTO param_sections (section_name, org_code, school_year) VALUES ('BSINFO 1A', 'BSIT', '2025-2026');
            INSERT INTO param_sections (section_name, org_code, school_year) VALUES ('BSINFO 1B', 'BSIT', '2025-2026');
            INSERT INTO param_sections (section_name, org_code, school_year) VALUES ('BSINFO 1C', 'BSIT', '2025-2026');
            INSERT INTO param_sections (section_name, org_code, school_year) VALUES ('BSCS1A', 'BSCS', '2025-2026');
            INSERT INTO param_sections (section_name, org_code, school_year) VALUES ('BSCS1B', 'BSCS', '2025-2026');

     
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_sections');
    }
};
