<?php

namespace App\Livewire\Account;

use Livewire\Component;

class AccountIndex extends Component
{

    public function render()
    {
        return view('livewire.account.account-index',['entries'=>[]]);
    }
}
