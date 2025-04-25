<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login | APINFOTECH')]
class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email|max:150|exists:users,email',
            'password' => 'required|min:8|max:20'
        ]);

        if(!Auth::attempt(['email' => $this->email, 'password' => $this->password]))
        {
            session()->flash('error', 'Invalid Credentials');
            return;
        }

        return $this->redirect('/', navigate: true);
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
