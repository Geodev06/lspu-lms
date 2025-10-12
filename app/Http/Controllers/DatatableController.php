<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamModuleAttachment;
use App\Models\ParamOrganization;
use App\Models\ParamSection;
use App\Models\SetupActivity;
use App\Models\SetupActivityQuestion;
use App\Models\User;
use App\Models\UserActivitySubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{
    public function table_users(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = User::orderBy('created_at', 'desc')->get();


                return DataTables::of($query)
                    ->addColumn('name', function ($row) {
                        return  decrypt($row->first_name) . ' ' . decrypt($row->middle_name) . ' ' . decrypt($row->last_name) . ' ' . decrypt($row->name_ext);
                    })

                    ->addColumn('status', function ($row) {
                        return  $row->active_flag == 1 ? 'Active' : 'Inactive';
                    })

                    ->addColumn('control_no', function ($row) {
                        return  $row->control_no ?? 'Not Set';
                    })
                    ->addColumn('section', function ($row) {
                        return  ParamSection::find($row->section_id)->section_name;
                    })

                    ->addColumn('org', function ($row) {
                        return  ParamOrganization::where('org_code', $row->org_code)->first()->name;
                    })

                    ->addColumn('actions', function ($row) {

                        $user = $row;
                        $user->first_name = decrypt($row->first_name);
                        $user->middle_name = decrypt($row->middle_name);
                        $user->last_name = decrypt($row->last_name);
                        $user->name_ext = decrypt($row->name_ext);


                        $edit = route('user_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('user_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                            </div>
                        ";
                    })

                    ->rawColumns(['control_no',  'status', 'actions', 'org', 'name', 'section', 'email'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_organizations(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = ParamOrganization::orderBy('id', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('actions', function ($row) {

                        $edit = route('organization_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('organization_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                            </div>
                        ";
                    })

                    ->rawColumns(['org_code',  'name', 'department', 'actions'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_sections(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = ParamSection::orderBy('id', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('actions', function ($row) {

                        $edit = route('section_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('section_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                            </div>
                        ";
                    })

                    ->rawColumns(['org_code',  'section_name', 'school_year', 'actions'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_learning_courses(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = ParamLearningCourse::where('created_by', $user->id)->orderBy('id', 'desc')->get();


                return DataTables::of($query)
                    ->addColumn('active_flag', function ($row) {
                        return $row->active_flag == 'Y' ? 'Active' : 'Inactive';
                    })
                    ->addColumn('actions', function ($row) {

                        $edit = route('learning_course_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('learning_course_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);
                        $manage = route('learning_course_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_MANAGE)]);


                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                    data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='View'
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit' data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='Edit'
                                    >
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-dark' href='$manage' 
                                data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='Manage'
                                    >
                                    <span class='tf-icons bx bx-folder'></span>
                                </a>
                            </div>
                        ";
                    })

                    ->rawColumns(['course_code',  'title', 'org_code', 'actions', 'active_flag'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_learning_modules($course_id, Request $request)
    {

        try {


            $course_id = decrypt($course_id);

            $user = Auth::user();

            if ($request->ajax()) {


                $query = ParamLearningCourseModule::where('learning_course_id', $course_id)->orderBy('id', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('actions', function ($row) {

                        $edit = route('learning_module_form', ['course_id' => encrypt($row->learning_course_id), 'module_id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('learning_module_form', ['course_id' => encrypt($row->learning_course_id), 'module_id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);
                        $manage = route('learning_module_form', ['course_id' => encrypt($row->learning_course_id), 'module_id' => encrypt($row->id), 'action' => encrypt(ACTION_MANAGE)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view'
                                data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='View'
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' 
                                data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='Edit'
                                     href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-dark'
                                    data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='Manage'
                                        href='$manage'>
                                    <span class='tf-icons bx bx-folder'></span>
                                </a>
                            </div>
                        ";
                    })

                    ->rawColumns(['title', 'actions'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_module_attachments($module_id, Request $request)
    {

        try {


            $module_id = decrypt($module_id);

            $user = Auth::user();

            if ($request->ajax()) {


                $query = ParamModuleAttachment::where('module_id', $module_id)->orderBy('id', 'desc')->get();


                return DataTables::of($query)

                    ->editColumn('created_at', fn($row) => \Carbon\Carbon::parse($row->created_at)->format('Y-m-d'))

                    ->addColumn('actions', function ($row) {

                        $module = ParamLearningCourseModule::find($row->module_id);

                        $edit = route('learning_module_doc_form', ['course_id' => encrypt($module->learning_course_id), 'module_id' => encrypt($module->id), 'attachment_id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('learning_module_doc_form', ['course_id' => encrypt($module->learning_course_id), 'module_id' => encrypt($module->id), 'attachment_id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view'
                                data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='View'
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' 
                                data-bs-toggle='tooltip' 
                                    data-bs-placement='top'
                                    title='Edit'
                                     href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>
                               
                            </div>
                        ";
                    })

                    ->rawColumns(['file_name', 'category', 'created_at', 'actions'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_setup_activities(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = SetupActivity::where('created_by', $user->id)->orderBy('created_at', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('status', function ($row) {
                        return  $row->active_flag == 'Y' ? 'Active' : 'Inactive';
                    })

                    ->addColumn('type', function ($row) {

                        $type = '';

                        switch ($row->type) {
                            case MULTIPLE_CHOICE:
                                $type = 'Multiple Choice';
                                break;
                            case HANDS_ON:
                                $type = 'Hands On';
                                break;
                            case IDENTIFICATION:
                                $type = 'Identification';
                                break;
                            case ESSAY:
                                $type = 'Essay';
                                break;
                        }

                        return $type;
                    })

                    ->addColumn('org_code', function ($row) {
                        return   get_org_name($row->org_code);
                    })


                    ->addColumn('actions', function ($row) {



                        $edit = route('activity_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('activity_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);
                        $manage = route('activity_form', ['id' => encrypt($row->id), 'action' => encrypt(ACTION_MANAGE)]);


                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>

                                <a type='button' class='btn btn-icon btn-dark' href='$manage'>
                                    <span class='tf-icons bx bx-folder'></span>
                                </a>

                            </div>
                        ";
                    })

                    ->rawColumns(['title',  'status', 'actions', 'org_code', 'type'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_setup_questions($activity_id, Request $request)
    {

        try {


            $user = Auth::user();

            $activity_id = decrypt($activity_id);

            if ($request->ajax()) {


                $query = SetupActivityQuestion::where('activity_id', $activity_id)->orderBy('created_at', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('actions', function ($row) {

                        $edit = route('activity_question_form', ['activity_id' => encrypt($row->activity_id), 'id' => encrypt($row->id), 'action' => encrypt(ACTION_EDIT)]);
                        $view = route('activity_question_form', ['activity_id' => encrypt($row->activity_id), 'id' => encrypt($row->id), 'action' => encrypt(ACTION_VIEW)]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$view' 
                                >
                                    <span class='tf-icons text-white bx bx-file'></span>
                                </a>
                                <a type='button' class='btn btn-icon btn-info' href='$edit'>
                                    <span class='tf-icons bx bx-pencil'></span>
                                </a>


                            </div>
                        ";
                    })

                    ->rawColumns(['question',  'answer', 'actions', 'points'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_course_activities($course_id, Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = SetupActivity::where(
                    [
                        'course_id' => decrypt($course_id)
                    ]
                )->orderBy('created_at', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('status', function ($row) {
                        $submission = UserActivitySubmission::where([
                            'created_by' => Auth::user()->id,
                            'activity_id' => $row->id
                        ])->first();

                        if ($submission) {
                            $grade = $submission->grade ?? 0.0;

                            if ($submission->checked_flag == 1) {
                                return $grade . "%";
                            } else {
                                return "For Checking";
                            }
                        } else {
                            return "Not started.";
                        }
                    })

                    ->addColumn('items', function ($row) {
                        return  SetupActivityQuestion::where('activity_id', $row->id)->sum('points');
                    })

                    ->addColumn('module', function ($row) {
                        return get_module_name($row->module_id);
                    })

                    ->addColumn('type', function ($row) {

                        $type = '';

                        switch ($row->type) {
                            case MULTIPLE_CHOICE:
                                $type = 'Multiple Choice';
                                break;
                            case HANDS_ON:
                                $type = 'Hands On';
                                break;
                            case IDENTIFICATION:
                                $type = 'Identification';
                                break;
                            case ESSAY:
                                $type = 'Essay';
                                break;
                        }

                        return $type;
                    })


                    ->addColumn('actions', function ($row) {



                        if (!UserActivitySubmission::where(
                            [
                                'created_by' => Auth::user()->id,
                                'activity_id' => $row->id
                            ]
                        )->first()) {
                            $edit = route('user_activity_form', ['activity_id' => encrypt($row->id), 'action' => encrypt(ACTION_ADD)]);

                            return "
                            <div class='demo-inline-spacing text-center'>
                               
                                <a type='button' class='btn btn-icon btn-success' href='$edit'>
                                    <span class='tf-icons bx bxs-comment-check'></span>
                                </a>


                            </div>
                        ";
                        } else {

                            return "
                            <div class='demo-inline-spacing text-center'>
                                <span class='badge bg-label-success'>Done</span>
                            </div>";
                        }
                    })

                    ->rawColumns(['title',  'status', 'actions', 'module', 'items', 'type'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_course_activities_all(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = SetupActivity::where(
                    [
                        'org_code' => Auth::user()->org_code
                    ]
                )->orderBy('created_at', 'desc')->get();


                return DataTables::of($query)

                    ->addColumn('status', function ($row) {
                        $submission = UserActivitySubmission::where([
                            'created_by' => Auth::user()->id,
                            'activity_id' => $row->id
                        ])->first();

                        if ($submission) {
                            $grade = $submission->grade ?? 0.0;

                            if ($submission->checked_flag == 1) {
                                return $grade . "%";
                            } else {
                                return "For Checking";
                            }
                        } else {
                            return "Not started.";
                        }
                    })

                    ->addColumn('items', function ($row) {
                        return  SetupActivityQuestion::where('activity_id', $row->id)->sum('points');
                    })

                    ->addColumn('module', function ($row) {
                        return get_module_name($row->module_id);
                    })

                    ->addColumn('type', function ($row) {

                        $type = '';

                        switch ($row->type) {
                            case MULTIPLE_CHOICE:
                                $type = 'Multiple Choice';
                                break;
                            case HANDS_ON:
                                $type = 'Hands On';
                                break;
                            case IDENTIFICATION:
                                $type = 'Identification';
                                break;
                            case ESSAY:
                                $type = 'Essay';
                                break;
                        }

                        return $type;
                    })


                    ->addColumn('actions', function ($row) {



                        if (!UserActivitySubmission::where(
                            [
                                'created_by' => Auth::user()->id,
                                'activity_id' => $row->id
                            ]
                        )->first()) {
                            $edit = route('user_activity_form', ['activity_id' => encrypt($row->id), 'action' => encrypt(ACTION_ADD)]);

                            return "
                            <div class='demo-inline-spacing text-center'>
                               
                                <a type='button' class='btn btn-icon btn-success' href='$edit'>
                                    <span class='tf-icons bx bxs-comment-check'></span>
                                </a>


                            </div>
                        ";
                        } else {

                            return "
                            <div class='demo-inline-spacing text-center'>
                                <span class='badge bg-label-success'>Done</span>
                            </div>";
                        }
                    })

                    ->rawColumns(['title',  'status', 'actions', 'module', 'items', 'type'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_notifications(Request $request)
    {

        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = Notification::where('receiver_id', $user->id)->get();

                return DataTables::of($query)

                    ->addColumn('status', function ($row) {

                        return $row->seen_flag == 1 ? 'Seen' : 'Not Seen';
                    })

                    ->addColumn('icon', function ($row) {
                        return "
                            <div class='demo-inline-spacing text-center'>
                                <span class='tf-icons text-primary $row->icon'></span>
                            </div>";
                    })

                    ->addColumn('actions', function ($row) {

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$row->link'>
                                    <span class='tf-icons bx bxs-comment-check'></span>
                                </a>

                            </div>
                        ";
                    })

                    ->rawColumns(['title',  'message', 'actions', 'status', 'icon'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function table_pending_tasks(Request $request)
    {
        try {


            $user = Auth::user();

            if ($request->ajax()) {


                $query = DB::select("
                SELECT 
                        A.id,
                        A.activity_name,
                        A.created_at,
                        B.first_name,
                        B.last_name,
                        B.middle_name,
                        D.section_name,
                    case 
                        WHEN A.activity_type = 'HO' THEN 'Hands ON'
                        WHEN A.activity_type = 'I' THEN 'Identification'
                        WHEN A.activity_type = 'E' THEN 'Essay'
                    end as activity_type from user_activity_submissions A
                    JOIN users B ON B.id = A.created_by
                    JOIN setup_activities C ON C.id = A.activity_id
                    LEFT JOIN param_sections  D ON D.id = B.section_id
                    WHERE A.activity_type != 'MC'
                    AND C.created_by = ?
                    AND A.checked_flag = 0
                ", [$user->id]);

                return DataTables::of($query)

                    ->addColumn('name', function ($row) {
                        $name = decrypt($row->first_name) . ' ' . decrypt($row->middle_name) . ' ' . decrypt($row->last_name);
                        return $name;
                    })

                    ->addColumn('actions', function ($row) {

                        $link = route('user_activity_response', [
                            encrypt($row->id), encrypt(ACTION_EDIT)
                        ]);

                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary' href='$link'>
                                    <span class='tf-icons bx bxs-pencil'></span>
                                </a>

                            </div>
                        ";
                    })

                    ->rawColumns(['activity_name',  'name', 'section_name', 'activity_type', 'actions', 'created_at'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
