<?php

namespace App\Livewire\Pages;

use App\Models\ParamLearningCourse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Courses')]
class UserCourses extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search']; // Keep search in the URL

    // Reset pagination when search term is updated
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $courses = ParamLearningCourse::where('active_flag', 'Y')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('course_code', 'like', '%' . $this->search . '%');
            })
            ->paginate(9);

        return view('livewire.pages.user-courses', [
            'courses' => $courses,
        ]);
    }
}
