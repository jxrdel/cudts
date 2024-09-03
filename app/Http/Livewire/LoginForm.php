<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User as ActiveDirectoryUser;
use LdapRecord\Models\OpenLDAP\User;
use Livewire\Component;

class LoginForm extends Component
{
    public $user;
    public $username;
    public $password;

    public function render()
    {
        return view('livewire.login-form');
    }
    
    
    public function login(){
        // dd('Hi');
        // dd(ActiveDirectoryUser::all());

        $connection = Container::getConnection('default');
        $user = ActiveDirectoryUser::where('samaccountname', $this->username)->first(); //Gets user
        // dd($this->user);

        if ($user){ //If user is found..
            $ADuser = $connection->query()->where('samaccountname', '=', $this->username)->first(); //Gets user from AD
            // dd($ADuser);
            if ($connection->auth()->attempt($ADuser['distinguishedname'][0], $this->password)){ //Authenticate User
                // dd('Success');
                Auth::login($user);
                redirect()->route('/');
            }else {
                // dd('Error');
                $this->resetValidation();
                $this->addError('password', 'Incorrect password');
                $this->password = null;
            }
        }
        else{ //Display error if no user is found
            $this->addError('username', 'User not found');
        }
    }
}
