<?php

namespace App\Dto\Onboarding;

use App\Dto\BaseDto;

class Address extends BaseDto
{
    public string $addressLine1;
    public string $addressLine2;
    public string $city;
    public string $postcode;
    public ?int $stateId;
    public string $state;
    public ?int $countryId;

    public function __construct($addressLine1 = '', $addressLine2 = '', $city = '', $postcode = '', $state = '', $countryId = null, $stateId = null)
    {
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->state = $state;
        $this->countryId = $countryId;
        $this->stateId = $stateId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['addressLine1'] ?? '',
            $data['addressLine2'] ?? '',
            $data['city'] ?? '',
            $data['postcode'] ?? '',
            $data['state'] ?? '',
            $data['countryId'] ?? null,
            $data['stateId'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'state' => $this->state,
            'stateId' => $this->stateId,
            'countryId' => $this->countryId,
        ];
    }
}
