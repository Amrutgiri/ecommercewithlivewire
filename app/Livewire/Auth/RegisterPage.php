<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register | APINFOTECH')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    public function save(){
        $this->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:150',
            'password' => 'required|min:8|max:20',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        Auth::login($user);

        return $this->redirect('/', navigate: true);

    }
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
