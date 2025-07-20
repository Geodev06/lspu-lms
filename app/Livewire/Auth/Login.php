<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;



    public function submit()
    {
        $credentials = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $this->remember)) {

            if (!Auth::user()->email_verified_at) {
                Auth::user()->sendEmailVerificationNotification();
            }

            $this->redirect('/dashboard');
        } else {
            session()->flash('error', 'Invalid Institutional Email or Password.');
        }

        try {
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    #[Title('Login')]
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
