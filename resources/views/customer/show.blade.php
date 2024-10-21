@extends('layouts.default')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">{{ __('customer.Customer Info') }}</h2>

        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('customer.Personal Information') }}</h4>
            </div>
            <div class="card-body">
                <p><strong>{{ __('customer.Name') }}:</strong> {{ $customer->name }}</p>
                <p><strong>{{ __('customer.Email') }}:</strong> {{ $customer->email }}</p>
                <p><strong>{{ __('customer.Phone Number') }}:</strong> {{ $customer->phone }}</p>
                <p><strong>{{ __('customer.Subscription Type') }}:</strong> {{ ucfirst($customer->plan) }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('address.Address Information') }}</h4>
            </div>
            <div class="card-body">
                @if($customer->address)
                    <p><strong>{{ __('address.Address Line 1') }}:</strong> {{ $customer->address->line_1 }}</p>
                    <p><strong>{{ __('address.Address Line 2') }}:</strong> {{ $customer->address->line_2 ?? __('customer.N/A') }}</p>
                    <p><strong>{{ __('address.Country') }}:</strong> {{ $customer->address->country->name }}</p>
                    <p><strong>{{ __('address.State') }}:</strong> {{ $customer->address->state ?? $customer->address->state->name }}</p>
                    <p><strong>{{ __('address.City') }}:</strong> {{ $customer->address->city }}</p>
                    <p><strong>{{ __('address.Postcode') }}:</strong> {{ $customer->address->postcode ?? __('customer.N/A') }}</p>
                @else
                    <p>{{ __('customer.No address information available.') }}</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('payment.Payment Info') }}</h4>
            </div>
            <div class="card-body">
                @if($customer->paymentInfo)
                    <p><strong>{{ __('payment.Card Holder Name') }}:</strong> {{ $customer->paymentInfo->card_holder_name }}</p>
                    <p><strong>{{ __('payment.Card Number') }}:</strong> **** **** **** {{ substr($customer->paymentInfo->card_number, -4) }}</p>
                    <p><strong>{{ __('payment.Expiry Date') }}:</strong> {{ $customer->paymentInfo->expiry_date }}</p>
                @else
                    <p>{{ __('payment.No payment information available.') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
