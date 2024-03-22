<?php

namespace App\Livewire\Account;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class AccountCreate extends Component
{
    public $site, $password, $email, $phone;

    public function saveAccount()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'site' => 'required|string',
            'phone' => 'required',
        ]);

        try {
            $pincode = Crypt::decryptString($this->getUserPinCode());
            $encryptedPassword = $this->encryptPassword($this->password, $pincode);

            $account = Account::create([
                'email' => $this->email,
                'password' => $encryptedPassword,
                'site' => $this->site,
                'phone' => $this->phone,
            ]);

            if ($account) {
                notyf()->addSuccess('Data has been added successfully!');
                $this->resetErrorBag();
            }
        } catch (\Exception $e) {
            // Output the exception message for debugging
            dd($e->getMessage());
            notyf()->addError('Failed to add data account. Please try again.');
        }
    }

    private function getUserPinCode()
    {
        $user = User::find(auth()->id());

        if ($user) {
            return $user->pin_code;
        }

        return null;
    }

    private function encryptPassword($password, $pincode)
    {
        $hashedPassword = Hash::make($password . $pincode);
        return encrypt($hashedPassword, Str::random(16));
    }
    public function render()
    {
        return view('livewire.account.account-create');
    }
}
