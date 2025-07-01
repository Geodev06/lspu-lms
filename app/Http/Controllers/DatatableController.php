<?php

namespace App\Http\Controllers;

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


                $query = User::orderBy('created_at','desc')->get();


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


                        $edit = route('user_form', encrypt($row->id));



                        return "
                            <div class='demo-inline-spacing text-center'>
                                <a type='button' class='btn btn-icon btn-primary'  
                                @click=''>
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
}
