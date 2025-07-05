<?php

namespace App\Http\Controllers;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamModuleAttachment;
use App\Models\ParamOrganization;
use App\Models\ParamSection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
