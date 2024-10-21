<?php

namespace App\Dto\Onboarding;

use App\Dto\BaseDto;

class CustomerInfo extends BaseDto
{
    const FREE_PLAN = 'free';
    const PREMIUM_PLAN = 'premium';

    public string $name;
    public string $email;
    public string $phone;
    public string $plan;

    public function __construct($name = '', $email = '', $phone = '', $plan = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->plan = $plan;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['phone'] ?? '',
            $data['plan'] ?? 'free'
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'plan' => $this->plan,
        ];
    }
}

