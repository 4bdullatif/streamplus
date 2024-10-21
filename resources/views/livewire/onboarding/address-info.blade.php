<div>
    <h3 class="text-center">{{ __('address.Address Information') }}</h3>

    <div class="mb-3">
        <label for="addressLine1" class="form-label">{{ __('address.Address Line 1') }}</label>
        <input type="text" wire:model="address.addressLine1" id="addressLine1"
               class="form-control @error('address.addressLine1') is-invalid @enderror"
               placeholder="{{ __('address.Enter your address line 1') }}">
        @error('address.addressLine1') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="addressLine2" class="form-label">{{ __('address.Address Line 2') }}</label>
        <input type="text" wire:model="address.addressLine2" id="addressLine2" class="form-control"
               placeholder="{{ __('address.Enter your address line 2 (optional)') }}">
    </div>

    <div class="mb-3">
        <label for="country" class="form-label">{{ __('address.Country') }}</label>
        @livewire('dropdown', [
            'elementId' => 'country_id',
            'ajaxUrl' => route('countries-list'),
            'placeholder' => __('address.Enter your country'),
            'minimumInputLength' => 1,
            'modelValueKey' => 'countryId',
            'class' => isset($errors) && $errors->has('address.countryId') ? 'is-invalid' : '',
        ], key('country_id'))
        @error('address.countryId') <span class="invalid-feedback"
                                          style="display: block;">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">{{ __('address.City') }}</label>
        <input type="text" wire:model="address.city" id="city"
               class="form-control @error('address.city') is-invalid @enderror"
               placeholder="{{ __('address.Enter your city') }}">
        @error('address.city') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="postcode" class="form-label">{{ __('address.Postcode') }}</label>
        <input type="text" wire:model="address.postcode" id="postcode"
               class="form-control @error('address.postcode') is-invalid @enderror"
               placeholder="{{ __('address.Enter your postcode') }}">
        @error('address.postcode') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    @if ($stateIdRequired && $this->address['countryId'] ?? null)
        <div class="mb-3" id="state_id">
            <label for="state_id" class="form-label">{{ __('address.State') }}</label>
            @livewire('dropdown', [
                'elementId' => 'state_id_' . ($this->address['countryId'] ?? null),
                'ajaxUrl' => route('states-list'),
                'placeholder' => __('address.Enter your state'),
                'minimumInputLength' => 1,
                'modelValueKey' => 'stateId',
                'params' => ['country_id' => $this->address['countryId'] ?? null],
            ], key('stateId' . $this->address['countryId'] ?? null))
            @error('address.stateId') <span class="invalid-feedback"
                                            style="display: block;">{{ $message }}</span> @enderror
        </div>
    @else
        <div class="mb-3">
            <label for="state" class="form-label">{{ __('address.State') }}</label>
            <input type="text" wire:model="address.state" id="state"
                   class="form-control @error('address.state') is-invalid @enderror"
                   placeholder="{{ __('address.Enter your state') }}">
            @error('address.state') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    @endif
</div>
