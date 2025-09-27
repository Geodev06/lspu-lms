<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class ManageLearningCourses extends Component
{
    #[Title('Manage Learning Courses')]
    public function render()
    {
        return view('livewire.pages.manage-learning-courses');
    }
}
