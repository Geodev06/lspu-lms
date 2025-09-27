<?php

namespace App\Livewire;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamModuleAttachment;
use Livewire\Attributes\Title;
use Livewire\Component;

class ViewFile extends Component
{
    public $id;

    public $module_id;

    public $file_id;


    public $course;
    public $course_modules = [];

    public $recommended;
    public $module;


    public $search = '';
    public function mount($id, $module_id, $file_id)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->course = ParamLearningCourse::find($this->id);
            $this->course_modules = ParamLearningCourseModule::with('files')->where('learning_course_id', $this->id)->orderBy('id', 'asc')->get();
        }

        if ($module_id) {
            $this->module_id = decrypt($module_id);
            $this->module = ParamLearningCourseModule::find($this->module_id);
        }

        if ($file_id) {
            $this->file_id = decrypt($file_id);
        }
    }

    public function update()
    {
        $this->resetPage();
    }


    #[Title('Open File')]

    public function render()
    {
        $file = ParamModuleAttachment::find($this->file_id);
        return view('livewire.view-file', compact('file'));
    }
}
