<?php

namespace App\Repositories;

use App\Models\CustomerPaymentInfo;

class CustomerPaymentRepository extends BaseRepository
{

    function model(): string
    {
        return CustomerPaymentInfo::class;
    }
}
