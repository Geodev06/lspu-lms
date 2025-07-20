<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPassword extends Component
{

    public string $email = '';
    public string $status = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    public function submit()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        $this->status = __($status);
    }

    #[Layout('components.layouts.auth')]
    #[Title('Forgot Password')]
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
