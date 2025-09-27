<?php

namespace App\Livewire;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamModuleAttachment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ViewCourseFiles extends Component
{

    public $id;

    use WithPagination;
    public $module_id;

    public $course;
    public $course_modules = [];

    public $recommended;
    public $module;


    public $search = '';
    public function mount($id, $module_id)
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
    }

    public function update()
    {
        $this->resetPage();
    }


    #[Title('View Files')]

    public function render()
    {
        $attachtments = ParamModuleAttachment::where('module_id', $this->module_id)
            ->when($this->search, function ($query) {
                $query->where('file_name', 'like', '%' . $this->search . '%'); // Adjust 'name' to your column
            })
            ->paginate(9);
        return view('livewire.view-course-files', compact('attachtments'));
    }
}
