<?php

namespace App\Livewire\Forms;

use App\Models\ParamOrganization;
use App\Models\ParamSection;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserForm extends Component
{

    use WithFileUploads;

    public $id;
    public $action;

    public $user;

    public $control_no;

    public $first_name;
    public $middle_name;
    public $last_name;
    public $name_ext;

    public $sex;
    public $course;
    public $section;
    public $role;
    public $active_status;
    public $profile;



    public $email;
    public $password;

    public $courses = [];
    public $sections = [];



    public function mount($id = null, $action = null)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->action = decrypt($action);


            $this->user = User::find($this->id);

            $this->first_name = decrypt($this->user->first_name);
            $this->middle_name = decrypt($this->user->middle_name);
            $this->last_name = decrypt($this->user->last_name);
            $this->name_ext = decrypt($this->user->name_ext);

            $this->sex = $this->user->sex;

            $this->section = $this->user->section_id;
            $this->course = $this->user->org_code;
            $this->control_no = $this->user->control_no;

            $this->email = $this->user->email;
            $this->profile = $this->user->profile;
            $this->role = $this->user->role;
            $this->active_status = $this->user->active_flag;
        }

        $this->courses = ParamOrganization::all();
        $this->sections = ParamSection::where('org_code', $this->course)->get();
    }


    #[On('on-filter-section')]
    public function filter_section($org_code)
    {
        $this->sections = ParamSection::where('org_code', $org_code)->orderBy('section_name', 'asc')->get();
    }

    public function process()
    {
        $this->check_action();
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'name_ext' => 'nullable|string|max:10',
            'role' => 'required',
            'active_status' => 'required',
            'sex' => 'required|in:M,F',
            'course' => 'required|string|max:100',
            'section' => 'required|max:50',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id),
            ],
            'control_no' => [
                'required',
                'string',
                'max:15',
                Rule::unique('users')->ignore($this->id),
            ],

            'password' => 'nullable|string|min:6',
            'profile' => 'nullable|image|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $filename = null;

            // Check if profile is a valid uploaded file object
            if ($this->profile instanceof \Illuminate\Http\UploadedFile) {
                $filename = Str::random(20) . '.' . $this->profile->getClientOriginalExtension();
                $this->profile->storeAs('profile', $filename, 'public_path');
            }

            $data = [
                'first_name'  => encrypt($this->first_name),
                'middle_name' => encrypt($this->middle_name),
                'last_name'   => encrypt($this->last_name),
                'name_ext'    => encrypt($this->name_ext),
                'role'        => $this->role,
                'sex'         => $this->sex,
                'org_code'    => $this->course,
                'section_id'  => $this->section,
                'active_flag' => $this->active_status,
                'email'       => $this->email,
                'control_no'  => $this->control_no,
                'password'    => Hash::make('Default@123')
            ];

            
            if ($this->id) {
                if ($this->password) {
                    $data['password'] = Hash::make($this->password);
                }
                if ($filename !== null) {
                    $data['profile'] = 'uploads/profile/' . $filename;
                }

                User::find($this->id)->update($data);

                session()->flash('success', $this->email . ' has been successfully updated.');
                $this->redirect(route('users'), 1);
            } else {
                

                if(is_null($this->password))
                {
                    $this->password = 'Default@123';
                }

                
                $data['password'] = Hash::make($this->password);

                if ($filename !== null) {
                    $data['profile'] = 'uploads/profile/' . $filename;
                }

                User::create($data);

                session()->flash('success', $this->email . ' has been created successfully.');
                $this->redirect(route('users'));
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[Title('User Form')]
    public function render()
    {
        return view('livewire.forms.user-form');
    }
}
