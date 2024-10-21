<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function paymentInfos() {
        return $this->hasMany(CustomerPaymentInfo::class);
    }

    public function addresses() {
        return $this->hasMany(CustomerAddress::class);
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->addresses()->first(),
        );
    }


    public function paymentInfo(): Attribute {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->paymentInfos()->first(),
        );
    }
}
