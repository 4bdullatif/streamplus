<div>
    <h3 class="text-center">{{ __('payment.Payment Info') }}</h3>

    <div class="mb-3">
        <label for="cardNumber" class="form-label">{{ __('payment.Card Number') }}</label>
        <input type="text" wire:model="paymentInfo.cardNumber" id="cardNumber"
               class="form-control @error('paymentInfo.cardNumber') is-invalid @enderror"
               placeholder="{{ __('payment.Enter your card number') }}">
        @error('paymentInfo.cardNumber') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="expiryDate" class="form-label">{{ __('payment.Expiry Date (m/y)') }}</label>
        <input type="text" wire:model="paymentInfo.expiryDate" id="expiryDate"
               class="form-control @error('paymentInfo.expiryDate') is-invalid @enderror"
               placeholder="{{ __('payment.MM/YY') }}">
        @error('paymentInfo.expiryDate') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="cvc" class="form-label">{{ __('payment.CVC') }}</label>
        <input type="password" wire:model="paymentInfo.cvc" id="cvc"
               class="form-control @error('paymentInfo.cvc') is-invalid @enderror"
               placeholder="{{ __('payment.Enter CVC') }}" maxlength="3">
        @error('paymentInfo.cvc') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Inputmask("", {
                placeholder: "{{ __('payment.MM/YY') }}",
                alias: "datetime",
                inputFormat: "mm/yy",
                min: '{{ date('m/y') }}'
            }).mask(document.getElementById('expiryDate'));
        });
    </script>
@endpush
