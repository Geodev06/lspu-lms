<?php

namespace App\Livewire\Forms;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamOrganization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class LearningCourseForm extends Component
{
    public $id;
    public $action;

    public $record;

    public $title;
    public $description;
    public $course_code;
    public $org_code;
    public $active_flag;
    public $created_at;


    public $courses = [];
    public $modules = [];



    public function mount($id = null, $action = null)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->action = decrypt($action);


            $this->record = ParamLearningCourse::find($this->id);

            $this->org_code = $this->record->org_code;
            $this->title = $this->record->title;
            $this->description = $this->record->description;
            $this->course_code = $this->record->course_code;
            $this->active_flag = $this->record->active_flag;

            $this->modules = ParamLearningCourseModule::where('learning_course_id', $this->id)->get(['title','description']);

        }

        $this->courses = ParamOrganization::all();
    }

   


    #[On('update_description_value')]
    public function update_description_value($data) 
    {
        $this->description = $data;
    }


    public function randomImage() {
        $randomNumber = rand(1, 14);
        return 'education' . $randomNumber;
    }



    public function process()
    {
        $this->check_action();

        $validated_data = $this->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('param_learning_courses')->ignore($this->id),
            ],
            'title' => [
                'required',
                'string',
                'max:245',
            ],
            'org_code' => 'required',
            'description' => 'required|min:3|max:25000',
            'active_flag' => 'required',

        ]);

        try {
            DB::beginTransaction();

          

            $data = [
                'title'     => $this->title,
                'org_code'        => $this->org_code,
                'description'         => $this->description,
                'active_flag'    => $this->active_flag,
                'course_code'    => $this->course_code,
                'created_by'   => Auth::user()->id,
                'banner'        => $this->randomImage()
            ];

            if ($this->id) {
               

                ParamLearningCourse::find($this->id)->update($data);

                session()->flash('success', $this->course_code . ' has been successfully updated.');


            } else {
               
                ParamLearningCourse::create($data);

                session()->flash('success', $this->course_code . ' has been created successfully.');

            }

            $this->redirect(route('manage_learning_course'));


            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[Title('Learning Course Form')]

    public function render()
    {
        return view('livewire.forms.learning-course-form');
    }

}
