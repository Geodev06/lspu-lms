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
        Schema::create('param_i_d_e_s', function (Blueprint $table) {
            $table->id();
            $table->string('ide_name');
            $table->text('embed_code');
            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'PYTHON 3',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/fa65cce2f0abef09\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'PHP',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/d09c69825e9f183e\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'JAVASCRIPT',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/d2b3f54a5427673c\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'C#',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/aefe78b539f39f4f\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'C++',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/14e549cb0e20576c\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'JAVA',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/3436f798118cab53\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");

        

        DB::unprepared("
            INSERT INTO param_i_d_e_s (ide_name, embed_code) VALUES (
                'SQLite',
                '<body>
                    <div data-pym-src=\"https://www.jdoodle.com/embed/v1/16b2ef48a620ebf1\"></div>
                    <script src=\"https://www.jdoodle.com/assets/jdoodle-pym.min.js\" type=\"text/javascript\"></script>
                </body>'
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_i_d_e_s');
    }
};
