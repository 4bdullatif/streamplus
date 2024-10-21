<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }
}
