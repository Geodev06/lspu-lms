<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

class ResetPasword extends Component
{

    public $email;
    public $token;
    public $password;
    public $password_confirmation;
    public $status;
    public $userId;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function mount($token)
    {
        $this->token = $token;

        $record = DB::table('password_reset_tokens')
            ->where('email', request()->query('email'))
            ->first();

        if (! $record || ! Hash::check($token, $record->token)) {
            abort(404, 'Invalid or expired token.');
        }

        $this->email = $record->email;

        $user = User::where('email', $this->email)->first();
        if (! $user) {
            abort(404, 'User not found.');
        }

        $this->userId = $user->id;

    }

    public function submit()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        $this->status = __($status);

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __($status));
        }

        $this->addError('email', __($status));
    }
    #[Layout('components.layouts.auth')]
    #[Title('Forgot Password')]
    public function render()
    {
        return view('livewire.auth.reset-pasword');
    }
}
