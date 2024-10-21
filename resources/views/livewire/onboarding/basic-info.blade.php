<div>
    <h3 class="text-center">{{ __('customer.Customer Info') }}</h3>
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('customer.Name') }}</label>
        <input type="text" wire:model="customerInfo.name" id="name" class="form-control @error('customerInfo.name') is-invalid @enderror" placeholder="{{ __('customer.Enter your name') }}">
        @error('customerInfo.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('customer.Email') }}</label>
        <input type="email" wire:model="customerInfo.email" id="email" class="form-control @error('customerInfo.email') is-invalid @enderror" placeholder="{{ __('customer.Enter your email') }}">
        @error('customerInfo.email') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('customer.Phone Number') }}</label>
        <input type="text" wire:model="customerInfo.phone" id="customerInfo.phone" class="form-control @error('customerInfo.phone') is-invalid @enderror" placeholder="{{ __('customer.Enter your phone number') }}">
        @error('customerInfo.phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('customer.Subscription Type') }}</label>
        <div class="form-check">
            <input class="form-check-input @error('customerInfo.plan') is-invalid @enderror" type="radio" wire:model="customerInfo.plan" id="subscriptionFree" value="free">
            <label class="form-check-label" for="subscriptionFree">
                {{ __('customer.Free') }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('customerInfo.plan') is-invalid @enderror" type="radio" wire:model="customerInfo.plan" id="subscriptionPremium" value="premium">
            <label class="form-check-label" for="subscriptionPremium">
                {{ __('customer.Premium') }}
            </label>
        </div>
        @error('customerInfo.plan') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>
</div>
