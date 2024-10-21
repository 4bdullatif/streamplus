<?php

namespace App\Services;

use App\Dto\Onboarding\PaymentInfo;
use App\Models\Customer;
use App\Repositories\CustomerPaymentRepository;

class CustomerPaymentService
{
    private CustomerPaymentRepository $customerPaymentRepository;

    public function __construct(CustomerPaymentRepository $customerPaymentRepository)
    {

        $this->customerPaymentRepository = $customerPaymentRepository;
    }

    public function createCustomerPayment(Customer $customer, PaymentInfo $paymentInfo)
    {
        return $this->customerPaymentRepository->create([
            'customer_id' => $customer->id,
            'card_number' => $paymentInfo->cardNumber,
            'card_holder_name' => $customer->name,
            'expiry_date' => $paymentInfo->expiryDate,
            'cvv' => encrypt($paymentInfo->cvv),
        ]);
    }
}
