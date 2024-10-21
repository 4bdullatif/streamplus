<?php

namespace App\Livewire\Onboarding;

use App\Dto\Onboarding\PaymentInfo as PaymentInfoDto;
use Livewire\Component;

class PaymentInfo extends Component
{

    public array $paymentInfo = [];

    protected $listeners = ['validatePaymentInfo'];

    protected $rules = [
        'paymentInfo.cardNumber' => 'required|digits_between:13,16',
        'paymentInfo.expiryDate' => 'required|date_format:m/y|after:today',
        'paymentInfo.cvc' => 'required|digits:3',
    ];

    public function validatePaymentInfo() {
        $this->validate();

        $this->dispatch('paymentInfoUpdated', $this->paymentInfo);
        $this->dispatch('stepValidated');
    }

    public function mount()
    {
        $this->paymentInfo = PaymentInfoDto::fromArray([])->toArray();
    }
    public function render()
    {
        return view('livewire.onboarding.payment-info');
    }
}
