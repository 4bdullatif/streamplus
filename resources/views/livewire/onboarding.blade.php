<div class="container mt-5">
    <h2 class="text-center">Stream Plus</h2>


    <!-- Step 1 -->
    <div @class(['step' => true,'active' => $currentStep === App\Livewire\Onboarding::INFO_STEP]) id="step1">
        <livewire:onboarding.basic-info></livewire:onboarding.basic-info>
    </div>

    <!-- Step 2 -->
    <div @class(['step' => true,'active' => $currentStep === App\Livewire\Onboarding::ADDRESS_STEP]) id="step2">
        <livewire:onboarding.address-info></livewire:onboarding.address-info>
    </div>

    <div @class(['step' => true,'active' => $currentStep === App\Livewire\Onboarding::PAYMENT_STEP]) id="step3">
        <livewire:onboarding.payment-info></livewire:onboarding.payment-info>
    </div>

    @if ($currentStep === App\Livewire\Onboarding::CONFIRMATION_STEP)
        <div class="container mt-4">
            <h3>Confirm Your Details</h3>
            <hr>

            <h5>Customer Information</h5>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Name:</strong> {{ $customerInfo['name'] }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $customerInfo['email'] }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $customerInfo['phone'] }}</li>
                <li class="list-group-item"><strong>Plan:</strong> {{ ucfirst($customerInfo['plan']) }}</li>
            </ul>

            <h5>Address Information</h5>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Address Line 1:</strong> {{ $address['addressLine1'] }}</li>
                @if($address['addressLine2'])
                    <li class="list-group-item"><strong>Address Line 2:</strong> {{ $address['addressLine2'] }}</li>
                @endif
                <li class="list-group-item"><strong>City:</strong> {{ $address['city'] }}</li>
                <li class="list-group-item"><strong>Postcode:</strong> {{ $address['postcode'] }}</li>
                <li class="list-group-item"><strong>State:</strong> {{ $address['state'] }}</li>
                <li class="list-group-item"><strong>Country:</strong> {{ $address['country'] }}</li>
            </ul>

            @if ($paymentRequired)
                <h5>Payment Information</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Card Number:</strong> **** **** **** {{ substr($paymentInfo['cardNumber'], -4) }}</li>
                    <li class="list-group-item"><strong>Expiry Date:</strong> {{ $paymentInfo['expiryDate'] }}</li>
                </ul>
            @endif
        </div>

    @endif
    <div class="text-center">
        @if ($currentStep !== App\Livewire\Onboarding::INFO_STEP)
            <button type="button" id="prevBtn" wire:click="previousStep" class="btn btn-secondary">Previous</button>
        @endif
        @if ($currentStep !== App\Livewire\Onboarding::CONFIRMATION_STEP)
                <button type="button" class="btn btn-dark" id="nextBtn" wire:click="validateAndProcessed">Next</button>
        @else
                <button type="button" wire:click="submitForm" class="btn btn-success">Confirm & Submit</button>
        @endif
    </div>

</div>
