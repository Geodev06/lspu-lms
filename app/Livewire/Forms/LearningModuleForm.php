<?php

namespace App\Livewire\Forms;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class LearningModuleForm extends Component
{

    public $course_id;
    public $module_id;

    public $action;

    public $record;

    public $title;
    public $description;


    public $course_code;
    public $course_title;
    public $course_org_code;

    public function delete()
    {
        $this->check_action();

        session()->flash('success', $this->title . ' has been deleted successfully.');

        ParamLearningCourseModule::find($this->module_id)->delete();

        $this->redirect(route('learning_course_form', [
            'id' => encrypt($this->course_id),
            'action' => encrypt(ACTION_MANAGE),

        ]));
    }

    #[On('update_description_value')]
    public function update_description_value($data)
    {
        $this->description = $data;
    }


    public function mount($course_id = null, $module_id = null, $action = null)
    {

        $this->course_id = decrypt($course_id);
        $learning_course = ParamLearningCourse::find(decrypt($course_id));
        $this->course_code = $learning_course->course_code;
        $this->course_title = $learning_course->title;
        $this->course_org_code = $learning_course->org_code;

        if ($module_id) {
            $this->module_id = decrypt($module_id);

            $this->action = decrypt($action);

            $this->record = ParamLearningCourseModule::find($this->module_id);

            $this->title = $this->record->title;
            $this->description = $this->record->description;
        }
    }


    public function process()
    {
        $this->check_action();
        $validated_data = $this->validate([

            'title' => [
                'required',
                'string',
                'max:245',
            ],
            'description' => 'required|min:3|max:25000',

        ]);

        try {
            DB::beginTransaction();



            $data = [
                'title'         => $this->title,
                'description'   => $this->description,
                'learning_course_id' => $this->course_id

            ];

            if ($this->module_id) {


                ParamLearningCourseModule::find($this->module_id)->update($data);

                session()->flash('success', $this->title . ' has been successfully updated.');
            } else {

                ParamLearningCourseModule::create($data);

                session()->flash('success', $this->title . ' has been created successfully.');
            }

            $this->redirect(route('learning_course_form', [
                'id' => encrypt($this->course_id),
                'action' => encrypt(ACTION_MANAGE),

            ]));


            DB::commit();
        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            DB::rollBack();
        }
    }

    #[Title('Learning Module Form')]

    public function render()
    {
        return view('livewire.forms.learning-module-form');
    }
}
