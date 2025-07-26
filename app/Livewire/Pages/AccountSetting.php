<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class AccountSetting extends Component
{

    public  $old_password = '';
    public  $password = '';
    public  $password_confirmation = '';


    public  $first_name, $last_name, $middle_name, $name_ext;
    public $email, $profile, $sex, $student_no;


    public function mount()
    {
        $user = Auth::user();

        $this->first_name = decrypt($user->first_name);
        $this->last_name = decrypt($user->last_name);
        $this->middle_name = decrypt($user->middle_name);
        $this->name_ext = decrypt($user->name_ext);

        $this->sex = $user->sex;
        $this->email = $user->email;
        $this->profile = $user->profile;
        $this->student_no = $user->control_no;
    }

    public function change_basic()
    {
        $this->validate([
            'first_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'middle_name' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'name_ext' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'student_no' => 'required|unique:users,control_no,' . Auth::id(),
        ]);

        User::where('id', Auth::user()->id)->update(
            [
                'first_name' => encrypt($this->first_name),
                'middle_name' => encrypt($this->middle_name),
                'last_name' => encrypt($this->last_name),
                'name_ext' => encrypt($this->name_ext),
                'control_no' => $this->student_no,
            ]
        );

        session()->flash('success_profile', 'Password changed successfully.');
    }


    public function change_password()
    {
        $this->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->password)) {
            session()->flash('error_password', 'The old password is incorrect.');
            return;
        }

        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success_password', 'Password changed successfully.');
        $this->reset(['old_password', 'password', 'password_confirmation']);
    }


    #[Title('Settings')]
    public function render()
    {
        return view('livewire.pages.account-setting');
    }
}
