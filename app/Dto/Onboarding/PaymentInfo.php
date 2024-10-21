<?php

namespace App\Dto\Onboarding;

use App\Dto\BaseDto;

class PaymentInfo extends BaseDto
{
    public string $cardNumber;
    public string $cvv;
    public string $expiryDate;

    public function __construct($cardNumber = '', $cvv = '', $expiryDate = '')
    {
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->expiryDate = $expiryDate;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['cardNumber'] ?? '',
            $data['cvv'] ?? '',
            $data['expiryDate'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'cardNumber' => $this->cardNumber,
            'cvv' => $this->cvv,
            'expiryDate' => $this->expiryDate,
        ];
    }
}
