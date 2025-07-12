<?php

namespace App\Livewire\Forms;

use App\Models\ParamIDE;
use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamOrganization;
use App\Models\SetupActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class SetupActivitForm extends Component
{

    public $id;
    public $action;

    public $record;

    public $org_code;
    public $title;
    public $description;
    public $type;
    public $image;
    public $active_flag;
    public $course;
    public $module;

    public $courses = [];
    public $learning_courses = [];
    public $learning_modules = [];
    public $param_ides = [];


    public $include_ide = 0;
    public $ide_id;



    public function mount($id = null, $action = null)
    {
        if ($id) {

            $this->id = decrypt($id);
            $this->action = decrypt($action);

            $this->record = SetupActivity::find($this->id);
            $this->org_code = $this->record->org_code;
            $this->title = $this->record->title;
            $this->type = $this->record->type;
            $this->active_flag = $this->record->active_flag;

            $this->course = $this->record->course_id;
            $this->description = $this->record->description;

            $this->learning_modules = ParamLearningCourseModule::where('learning_course_id', $this->record->course_id)->orderBy('created_at', 'desc')->get();
            $this->module = $this->record->module_id;

            if($this->record->ide_id != null)
            {
                $this->include_ide = 1;
            }

            $this->ide_id = $this->record->ide_id;




        }

        $this->courses = ParamOrganization::all();
        $this->param_ides = ParamIDE::all();
        $this->learning_courses = ParamLearningCourse::where('created_by', Auth::user()->id)->get();
    }

    public function updatedIncludeIde($value)
    {
        $this->include_ide = $value;
    }

    #[On('on-filter-module')]
    public function filter_section($learning_course_id)
    {
        $this->learning_modules = ParamLearningCourseModule::where('learning_course_id', $learning_course_id)->orderBy('created_at', 'desc')->get();
    }


    #[On('update_description_value')]
    public function update_description_value($data)
    {
        $this->description = $data;
    }

    public function process()
    {
        $this->check_action();

        $rules = [

            'title' => 'required|string|max:245',
            'description' => 'required|string|max:20000',
            'org_code' => 'required',
            'type' => 'required',
            'module' => 'required',
            'course' => 'required',
            'active_flag' => 'required',
            'image' => 'nullable',

        ];

        if($this->include_ide)
        {
            $rules['ide_id'] = 'required';

        }else {

            unset($rules['ide_id']);
        }

        $validated_data = $this->validate($rules);

        try {

            DB::beginTransaction();


            $data = [

                'title'               => $this->title,
                'description'         => $this->description,
                'active_flag'         => $this->active_flag,
                'course'              => $this->course,
                'module'              => $this->module,
                'org_code'            => $this->org_code,
                'created_by'          => Auth::user()->id,
                'course_id'           => $this->course,
                'module_id'           => $this->module,
                'type'                => $this->type,
                'ide_id'              => $this->ide_id ?? null


            ];



            if ($this->id) {


                SetupActivity::find($this->id)->update($data);

                session()->flash('success', $this->title . ' has been successfully updated.');

                $this->redirect(route('manage_activity'));
            } else {

                SetupActivity::create($data);

                session()->flash('success', $this->title . ' has been created successfully.');

                $this->redirect(route('manage_activity'));
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[Title('Activty Setup Form')]

    public function render()
    {
        return view('livewire.forms.setup-activit-form');
    }
}
