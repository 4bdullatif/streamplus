<?php

namespace App\Services;

use App\Dto\Onboarding\CustomerInfo;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {

        $this->customerRepository = $customerRepository;
    }

    public function create(CustomerInfo $customerInfo): ?Customer {
        return $this->customerRepository->create([
            'name' => $customerInfo->name,
            'email' => $customerInfo->email,
            'phone' => $customerInfo->phone,
            'plan' => $customerInfo->plan,
        ]);
    }
}
