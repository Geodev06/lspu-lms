<?php

namespace App\Livewire\Auth;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Models\ParamOrganization;
use App\Models\ParamSection;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{

    public $first_name;
    public $middle_name;
    public $last_name;
    public $name_ext;

    public $control_no;

     public string $recaptchaToken = '';


    public $sex;
    public $course;
    public $section;

    public $email;
    public $password;

    public $courses = [];
    public $sections = [];



    public function mount()
    {
        $this->courses = ParamOrganization::all();
        $this->sections = ParamSection::where('org_code', $this->course)->get();
    }

    #[On('on-filter-section')]
    public function filter_section($org_code)
    {
        $this->sections = ParamSection::where('org_code', $org_code)->orderBy('section_name', 'asc')->get();
    }

    public function register()
    {
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'name_ext' => 'nullable|string|max:10',

            'sex' => 'required|in:M,F',
            'course' => 'required|string|max:100',
            'section' => 'required|string|max:50',

            'email' => 'required|email|unique:users,email',
            'control_no' => 'required|unique:users,control_no',
            'password' => 'required|string|min:6',
        ]);


      

        try {
            DB::beginTransaction();

            User::create([
                'first_name' => encrypt($this->first_name),
                'middle_name' => encrypt($this->middle_name),
                'last_name' => encrypt($this->last_name),
                'name_ext' => encrypt($this->name_ext),
                'role' => ROLE_STUDENT,
                'sex' => $this->sex,
                'org_code' => $this->course,
                'section_id' => $this->section,
                'control_no' => $this->control_no,

                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            session()->flash('success', $this->email . ' has been created successfully.');

            $this->redirect('/');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }

    #[Title('Register')]
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
