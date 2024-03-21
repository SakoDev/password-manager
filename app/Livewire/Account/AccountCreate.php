<?php

namespace App\Livewire\Account;

use Livewire\Component;

class AccountCreate extends Component
{
    public $site,$password,$email,$phone;
    public function saveAccount(){
        $this->validate([
            'email'=>'required|email',
            'password'=>'required|string',
            'site'=>'string',
            'phone'=>'numeric',
        ]);
    }
    public function render()
    {
        return view('livewire.account.account-create');
    }
}
