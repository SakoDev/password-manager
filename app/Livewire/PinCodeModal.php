<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class PinCodeModal extends Component
{
    public $pinCode;

    protected $listeners = ['showPinCodeModal'];

    public function showPinCodeModal()
    {
        $this->resetErrorBag();
        $this->pinCode = '';
        $this->dispatchBrowserEvent('show-pincode-modal');
    }

    public function verifyPinCode()
    {
        $this->validate([
            'pinCode' => 'required', // Add any pin code validation rules here
        ]);

        // Verify pin code logic here
        if ($this->pinCode === Crypt::decryptString($this->getUserPinCode())) { // Replace $correctPinCode with the actual correct pin code
            // Pin code is correct, emit event to show password modal
            $this->dispatch('showPasswordModal');
        } else {
            // Pin code is incorrect, display error message
            $this->addError('pinCode', 'Incorrect pin code. Please try again.');
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
    public function render()
    {
        return view('livewire.pin-code-modal');
    }
}
