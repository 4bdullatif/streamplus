<?php

namespace App\Repositories;

use App\Models\CustomerAddress;

class CustomerAddressRepository extends BaseRepository
{

    function model(): string
    {
        return CustomerAddress::class;
    }
}
