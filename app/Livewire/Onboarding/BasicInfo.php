<?php

namespace App\Livewire\Onboarding;

use App\Dto\Onboarding\CustomerInfo;
use App\Enums\Plan;
use Livewire\Component;

class BasicInfo extends Component
{
    public array $customerInfo;

    public array $rules = [
        'customerInfo.name' => 'required|string',
        'customerInfo.email' => 'required|email|unique:customers,email',
        'customerInfo.phone' => 'required|numeric|min_digits:10|',
        'customerInfo.plan' => 'required|string|in:free,premium',
    ];
    protected $listeners = ['validateBasicInfo'];
    public function validateBasicInfo()
    {
        $this->validate();

        $this->dispatch('basicInfoUpdated', $this->customerInfo);
        $this->dispatch('updatePaymentRequired', $this->customerInfo['plan'] === Plan::PREMIUM->value);
        $this->dispatch('stepValidated');

    }
    public function render()
    {
        return view('livewire.onboarding.basic-info');
    }

    public function mount()
    {
        $this->customerInfo = CustomerInfo::fromArray([])->toArray();
    }
}
