<?php

namespace App\Livewire;

use App\Actions\CustomerRegister;
use App\Dto\Onboarding\Address;
use App\Dto\Onboarding\CustomerInfo;
use App\Dto\Onboarding\PaymentInfo;
use Livewire\Attributes\On;
use Livewire\Component;

class Onboarding extends Component
{
    const INFO_STEP = 1;
    const ADDRESS_STEP = 2;
    const PAYMENT_STEP = 3;
    const CONFIRMATION_STEP = 4;

    const stepValidationEvents = [
        self::INFO_STEP => 'validateBasicInfo',
        self::ADDRESS_STEP => 'validateAddress',
        self::PAYMENT_STEP => 'validatePaymentInfo',
    ];
    public int $currentStep = self::INFO_STEP;

    public $address = [];
    public $paymentInfo = [];
    public $customerInfo = [];

    public $paymentRequired = false;

    public function render()
    {
        return view('livewire.onboarding');
    }

    public function submitForm()
    {
        $customerInfo = CustomerInfo::fromArray($this->customerInfo);
        $address = Address::fromArray($this->address);
        $paymentInfo = PaymentInfo::fromArray($this->paymentInfo);

        $result = app(CustomerRegister::class)
            ->withCustomerInfo($customerInfo)
            ->withAddress($address);
        if ($this->paymentRequired)
            $result->withPaymentInfo($paymentInfo);

        $customer = $result->register();

        if ($customer) {
            return redirect()->route('customer.show', $customer);
        } else {
            $this->js(<<<JS
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to register customer',
                });
JS);
        }
    }

    #[On('stepValidated')]
    public function nextStep(): void
    {
        if ($this->currentStep === self::ADDRESS_STEP) {
            if ($this->paymentRequired) {
                $this->currentStep = self::PAYMENT_STEP;
            } else {
                $this->currentStep = self::CONFIRMATION_STEP;
            }
        } else if ($this->currentStep < self::CONFIRMATION_STEP) {
            $this->currentStep++;
        }
    }

    public function previousStep(): void
    {
        if ($this->currentStep <= self::INFO_STEP) {
            return;
        }
        if ($this->currentStep === self::CONFIRMATION_STEP) {
            if ($this->paymentRequired) {
                $this->currentStep = self::PAYMENT_STEP;
            } else {
                $this->currentStep = self::ADDRESS_STEP;
            }
        } else {
            $this->currentStep--;
        }
    }

    #[On('basicInfoUpdated')]
    public function updateBasicInfo(array $customerInfo): void
    {
        $this->customerInfo = $customerInfo;
    }

    #[On('addressUpdated')]
    public function updateAddress($address): void
    {
        $this->address = $address;
    }

    #[On('paymentInfoUpdated')]
    public function updatePaymentInfo($paymentInfo): void
    {
        $this->paymentInfo = $paymentInfo;
    }

    #[On('updatePaymentRequired')]
    public function updatePaymentRequired($paymentRequired): void
    {
        $this->paymentRequired = $paymentRequired;
        $this->paymentInfo = [];
    }

    public function validateAndProcessed()
    {
        $this->dispatch(self::stepValidationEvents[$this->currentStep]);
    }
}
