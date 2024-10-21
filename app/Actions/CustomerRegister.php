<?php

namespace App\Actions;


use App\Dto\Onboarding\Address;
use App\Dto\Onboarding\CustomerInfo;
use App\Dto\Onboarding\PaymentInfo;
use App\Models\Customer;
use App\Services\CustomerAddressService;
use App\Services\CustomerPaymentService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;

class CustomerRegister
{
    private CustomerPaymentService $customerPaymentService;
    private CustomerAddressService $customerAddressService;
    private CustomerService $customerService;

    public function __construct(CustomerAddressService $customerAddressService,
                                CustomerPaymentService $customerPaymentService,
                                CustomerService        $customerService)
    {

        $this->customerPaymentService = $customerPaymentService;
        $this->customerAddressService = $customerAddressService;
        $this->customerService = $customerService;
    }

    private ?CustomerInfo $customerInfo;
    private ?Address $address;
    private ?PaymentInfo $paymentInfo = null;

    public function withCustomerInfo(CustomerInfo $customerInfo): self
    {
        $this->customerInfo = $customerInfo;
        return $this;
    }

    public function withAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function withPaymentInfo(PaymentInfo $paymentInfo): self
    {
        $this->paymentInfo = $paymentInfo;
        return $this;
    }

    public function register(): ?Customer
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerService->create($this->customerInfo);
            if ($this->paymentInfo)
                $this->customerPaymentService->createCustomerPayment($customer, $this->paymentInfo);
            $this->customerAddressService->createUserAddress($customer, $this->address);
            DB::commit();
            return $customer;
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Error while registering customer', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
