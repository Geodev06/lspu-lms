<?php

namespace App\Livewire\Forms;

use App\Models\ParamIDE;
use App\Models\ParamLearningCourse;
use App\Models\ParamLearningCourseModule;
use App\Models\ParamOrganization;
use App\Models\SetupActivity;
use App\Models\UserActivitySubmission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class SetupActivitForm extends Component
{

    use WithPagination;


    public string $search = '';
    public string $date = '';
    public string $section = '';
    public string $score = '';

    public $page = 1;

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

    public $a_flag, $v_flag, $k_flag, $r_flag = 0;




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

            if ($this->record->ide_id != null) {
                $this->include_ide = 1;
            }

            $this->ide_id = $this->record->ide_id;

            $this->a_flag = $this->record->a_flag;
            $this->k_flag = $this->record->k_flag;
            $this->v_flag = $this->record->v_flag;
            $this->r_flag = $this->record->r_flag;
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

        if ($this->include_ide) {
            $rules['ide_id'] = 'required';
        } else {

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
                'ide_id'              => $this->ide_id ?? null,

                'a_flag'              => $this->a_flag ?? 0,
                'v_flag'              => $this->v_flag ?? 0,
                'r_flag'              => $this->r_flag ?? 0,
                'k_flag'              => $this->k_flag ?? 0

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

    public function update($name)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = DB::table('user_activity_submissions as A')
            ->join('users as B', 'B.id', '=', 'A.created_by')
            ->join('param_sections as C', 'C.id', '=', 'B.section_id')
            ->select(
                'A.*',
                'B.first_name',
                'B.middle_name',
                'C.section_name',
                'B.last_name'
            )
            ->where('activity_id', $this->id)
            ->orderByDesc('A.created_at');

        if ($this->date) {
            $query->whereDate('A.created_at', $this->date);
        }

        if ($this->section) {
            $query->where('C.section_name', 'like', '%' . $this->section . '%');
        }

        if ($this->score !== '') {
            $query->where('A.grade', $this->score);
        }

        if ($this->search) {
            // Unfortunately, you can't search decrypted fields in DB directly.
            // So you'll need to keep this search after pagination if you must decrypt names
            // We'll do it after paginating
        }

        $perPage = 10;
        $paginated = $query->paginate($perPage);

        // Now decrypt the names AFTER pagination
        $paginated->getCollection()->transform(function ($item) {
            $item->full_name = decrypt($item->first_name) . ' ' .
                decrypt($item->middle_name) . ' ' .
                decrypt($item->last_name);
            return $item;
        });

        // Optionally filter by search (note: after decrypting, so it's in-memory)
        if ($this->search) {
            $filtered = $paginated->getCollection()->filter(function ($item) {
                return str_contains(strtolower($item->full_name), strtolower($this->search));
            });

            // Re-paginate the filtered results
            $paginated = new LengthAwarePaginator(
                $filtered->forPage($this->page, $perPage),
                $filtered->count(),
                $perPage,
                $this->page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        return view('livewire.forms.setup-activit-form', [
            'submissions' => $paginated,
        ]);
    }
}
