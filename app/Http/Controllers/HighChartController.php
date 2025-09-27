<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HighChartController extends Controller
{

    public function get_line_1()
    {
        try {

            $query = DB::select(
                "
                WITH months AS (
                SELECT 'January' AS month_name, 1 AS month_num UNION ALL
                SELECT 'February', 2 UNION ALL
                SELECT 'March', 3 UNION ALL
                SELECT 'April', 4 UNION ALL
                SELECT 'May', 5 UNION ALL
                SELECT 'June', 6 UNION ALL
                SELECT 'July', 7 UNION ALL
                SELECT 'August', 8 UNION ALL
                SELECT 'September', 9 UNION ALL
                SELECT 'October', 10 UNION ALL
                SELECT 'November', 11 UNION ALL
                SELECT 'December', 12
                )

                SELECT
                COALESCE(sub.count, 0) AS count,
                sub.name,
                m.month_name AS created_date
                FROM months m
                LEFT JOIN (
                    SELECT
                    COUNT(A.id) AS count,
                    C.name,
                    DATE_FORMAT(A.created_at, '%M') AS created_date
                    FROM user_activity_submissions A
                    JOIN users B ON B.id = A.created_by
                    JOIN param_organizations C ON C.org_code = B.org_code
                    GROUP BY C.name, created_date
                ) sub ON sub.created_date = m.month_name
                ORDER BY m.month_num

                "
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_bar_1()
    {
        try {

            $query = DB::select(
                "
                    SELECT SUM(successes) s, SUM(failures) f, modality from modality_bandits group by modality

                "
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_t_bar_1()
    {
        try {

            $query = DB::select(
                "
                  SELECT 
                        types.activity_type_label,
                        ROUND(COALESCE(avg_grades.grade, 0), 2) AS grade
                    FROM (
                        SELECT 'HO' AS activity_type_code, 'Hands On' AS activity_type_label
                        UNION ALL
                        SELECT 'I', 'Identification'
                        UNION ALL
                        SELECT 'E', 'Essay'
                        UNION ALL
                        SELECT 'MC', 'Multiple Choice'
                    ) AS types
                    LEFT JOIN (
                        SELECT 
                            uas.activity_type,
                            AVG(uas.grade) AS grade
                        FROM user_activity_submissions uas
                        JOIN setup_activities sa ON sa.id = uas.activity_id
                        -- Add any filtering on setup_activities here if needed
                        WHERE sa.created_by = ?
                        GROUP BY uas.activity_type
                        ORDER BY uas.activity_type
                    ) AS avg_grades
                    ON avg_grades.activity_type = types.activity_type_code

                ",
                [Auth::user()->id]
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_pie_1()
    {
        try {

            $query = DB::select(
                "
                  SELECT 
                    avg(A.grade) y, C.name from user_activity_submissions A
                    JOIN users B ON B.id = A.created_by
                    JOIN param_organizations C ON C.org_code = B.org_code
                    GROUP BY C.name

                "
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_pie_2()
    {
        try {

            $query = DB::select(
                "
                SELECT 
                    ROUND(AVG(auditory_score), 2) AS a,
                    ROUND(AVG(visual_score), 2) AS v,
                    ROUND(AVG(kinesthetic_score), 2) AS k,
                    ROUND(AVG(reading_and_writing_score), 2) AS r
                FROM modality_stats

                "
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_bar_2()
    {
        try {

            $query = DB::select(
                "
                    SELECT sum(successes) s, sum(failures) f, modality FROM modality_bandits group by modality order by modality
                "
            );

            return response()->json($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
