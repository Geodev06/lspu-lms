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
        Schema::create('param_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_code');
            $table->string('department');
            $table->string('name');
            $table->timestamps();
        });

          DB::unprepared("
            INSERT INTO param_organizations (org_code, name, department) 
            VALUES ('BSCS', 'Bachelor of Science in Computer Science', 'College of Computer Studies');

            INSERT INTO param_organizations (org_code, name, department) 
            VALUES ('BSIT', 'Bachelor of Science in Information Technology', 'College of Computer Studies');

    
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CAS_BSBIO', 'Bachelor of Science in Biology', 'College of Arts and Sciences');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CAS_BSPYSCH', 'Bachelor of Science in Psychology', 'College of Arts and Sciences');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CBAA_BSOA', 'Bachelor of Science in Office Administration', 'College of Business Administration and Accountancy');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CBAA_BSBA_FM', 'Bachelor of Science in Business Administration - Financial Management', 'College of Business Administration and Accountancy');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CBAA_BSBA_MM', 'Bachelor of Science in Business Administration - Marketing Management', 'College of Business Administration and Accountancy');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CBAA_BSA', 'Bachelor of Science in Accountancy', 'College of Business Administration and Accountancy');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSINFOTECH', 'Bachelor of Science in Information Technology', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSINFOTECH_AMG', 'Bachelor of Science in Information Technology - Animation and Motion Graphics', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSINFOTECH_SMP', 'Bachelor of Science in Information Technology - Service Management Program', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSINFOTECH_WMAD', 'Bachelor of Science in Information Technology - Web and Mobile App Dev', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSCS', 'Bachelor of Science in Computer Science', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_BSCS_GV', 'Bachelor of Science in Computer Science - Graphics and Visualization', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCS_MIT', 'Master in Information Technology', 'College of Computer Studies');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CCJE_BSCRIM', 'Bachelor of Science in Criminology', 'College of Criminal Justice Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('COE_BSECE', 'Bachelor of Science in Electronics Engineering', 'College of Engineering');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('COE_BSEE', 'Bachelor of Science in Electrical Engineering', 'College of Engineering');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('COE_BSCPE', 'Bachelor of Science in Computer Engineering', 'College of Engineering');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CHMT_BSHM', 'Bachelor of Science in Hospitality Management', 'College of Hospitality Management and Tourism');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CHMT_BSTM', 'Bachelor of Science in Tourism Management', 'College of Hospitality Management and Tourism');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT', 'Bachelor of Science in Industrial Technology', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_AT', 'BSIT - Automotive Technology', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_AD', 'BSIT - Architectural Drafting', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_ELT', 'BSIT - Electrical Technology', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_ELX', 'BSIT - Electronics Technology', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_FBPSM', 'BSIT - Food and Beverage Prep and Service Mgmt', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CIT_BSIT_HVACR', 'BSIT - Heating, Ventilation, AC & Refrigeration', 'College of Industrial Technology');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BSED_ENG', 'Bachelor of Secondary Education - English', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BSED_FIL', 'Bachelor of Secondary Education - Filipino', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BSED_MATH', 'Bachelor of Secondary Education - Mathematics', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BSED_SCI', 'Bachelor of Secondary Education - Science', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BSED_SOCSCI', 'Bachelor of Secondary Education - Social Science', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BEED', 'Bachelor of Elementary Education', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BPED', 'Bachelor of Physical Education', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTLED_HE', 'BTLEd - Home Economics', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTLED_IA', 'BTLEd - Industrial Arts', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTVTED_ELT', 'BTVTEd - Electrical Technology', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTVTED_ELTS', 'BTVTEd - Electronics Technology', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTVTED_FSM', 'BTVTEd - Food and Service Management', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_BTVTED_GFD', 'BTVTEd - Garments, Fashion and Design', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('CTE_CTP', 'Certificate in Teaching Proficiency', 'College of Teacher Education');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_EDD', 'Doctor of Education', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_EM', 'Master of Arts in Education - Educational Management', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_ENG', 'Master of Arts in Education - English', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_FIL', 'Master of Arts in Education - Filipino', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_GC', 'Master of Arts in Education - Guidance and Counseling', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_MATH', 'Master of Arts in Education - Mathematics', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_PE', 'Master of Arts in Education - Physical Education', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_SCI', 'Master of Arts in Education - Science and Technology', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_SOCSCI', 'Master of Arts in Education - Social Science', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('GSAR_MAED_THE', 'Master of Arts in Education - Tech and Home Economics', 'Graduate Studies and Applied Research');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('SHS_ABM', 'Accountancy, Business, and Management', 'Senior High School');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('SHS_HUMSS', 'Humanities and Social Sciences', 'Senior High School');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('SHS_STEM', 'Science, Technology, Engineering and Mathematics', 'Senior High School');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('SHS_TVL_HE', 'TVL - Home Economics', 'Senior High School');
            INSERT INTO param_organizations (org_code, name, department) VALUES ('SHS_TVL_ICT', 'TVL - Information and Communications Technology', 'Senior High School');

        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_organizations');
    }
};
