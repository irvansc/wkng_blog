<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Str;
class AuthorResetForm extends Component
{
    public $email, $token, $new_password, $confirm_password;


    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }
    public function ResetHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:5',
            'confirm_password' => 'same:new_password',
        ], [
            'email.required' => 'The email field is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'This email is not registered',
            'new_password.required' => 'Enter new Password',
            'new_password.min' => 'The minimum password 5 character',
            'confirm_password.same' => 'The confirm password and new passowrd must math'

        ]);

        $chek_token = DB::table('password_reset_tokens')->where([
            'email' => $this->email,
            'token' => $this->token
        ])->first();
        if (!$chek_token) {
            session()->flash('fail', 'Invalid token access.');
        } else {
            User::where('email', $this->email)->update([
                'password' => Hash::make($this->new_password)
            ]);
            DB::table('password_reset_tokens')->where([
                'email'=> $this->email
            ])->delete();
        }

        $success_token = Str::random(64);

        session()->flash('success', 'Your password has been updated successfuly.
        Login with your email (<span>'.$this->email.'</span>) and your new password');

        $this->redirectRoute('author.login', ['tkn'=> $success_token, 'UEmail'=> $this->email]);
    }
    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
