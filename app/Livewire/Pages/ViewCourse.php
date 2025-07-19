<?php

namespace App\Livewire\Pages;

use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class ViewCourse extends Component
{

    public $id;

    public $course;
    public $course_modules = [];

    public $recommended;

    public function mount($id)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->course = ParamLearningCourse::find($this->id);
            $this->course_modules = ParamLearningCourseModule::with('files')->where('learning_course_id', $this->id)->orderBy('id', 'asc')->get();
        }


        $recommended = $this->recommend(Auth::user()->id);

        $this->recommended = $recommended['recommended_modality'];
        
    }

    #[Title('View')]

    public function render()
    {
        return view('livewire.pages.view-course');
    }
}
