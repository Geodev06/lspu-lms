<?php

namespace App\Livewire\Forms;

use App\Models\ParamOrganization;
use App\Models\ParamSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class SectionForm extends Component
{

    public $id;
    public $action;

    public $record;

    public $course;
    public $section_name;
    public $school_year;

    public $courses = [];
    public $school_years = [];


    public function mount($id = null, $action = null)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->action = decrypt($action);


            $this->record = ParamSection::find($this->id);

            $this->course = $this->record->org_code;
            $this->section_name = $this->record->section_name;
            $this->school_year = $this->record->school_year;
        }

        $this->courses = ParamOrganization::all();

        $this->school_years = $this->generate_school_years(2025);

    }


    public function process()
    {
        $this->check_action();
        $validated_data = $this->validate([
            'course' => [
                'required',
                'string',
            ],
            'section_name' => [
                'required',
                'string',
                'max:245',
                Rule::unique('param_sections')->ignore($this->id),
            ],

            'school_year' => 'required|string|max:245',
        ]);

        try {
            DB::beginTransaction();



            $data = [
                'org_code'        => $this->course,
                'section_name'         => $this->section_name,
                'school_year'    => $this->school_year
            ];

            if ($this->id) {


                ParamSection::find($this->id)->update($data);

                session()->flash('success', $this->section_name . ' has been successfully updated.');

                $this->redirect(route('sections'));
            } else {

                ParamSection::create($data);

                session()->flash('success', $this->section_name . ' has been created successfully.');

                $this->redirect(route('sections'));
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[On('Section Form')]
    public function render()
    {
        return view('livewire.forms.section-form');
    }
}
