<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $guarded = [];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
