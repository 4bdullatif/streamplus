<?php

namespace App\Services;

use App\Dto\Onboarding\Address;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\User;
use App\Repositories\CustomerAddressRepository;

class CustomerAddressService
{
    private CustomerAddressRepository $customerAddressRepository;

    public function __construct(CustomerAddressRepository $customerAddressRepository)
    {

        $this->customerAddressRepository = $customerAddressRepository;
    }

    public function createUserAddress(Customer $customer, Address $address): CustomerAddress {

        return $this->customerAddressRepository->create([
            'customer_id' => $customer->id,
            'line_1' => $address->addressLine1,
            'line_2' => $address->addressLine2,
            'country_id' => $address->countryId,
            'state' => $address->state,
            'state_id' => $address->stateId,
            'city' => $address->city,
            'postcode' => $address->postcode,
        ]);
    }
}
