<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends BaseRepository
{

    function model(): string
    {
        return Customer::class;
    }
}
