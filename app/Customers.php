<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public function getFullNameAttribute()
    {
        $firstName = $this->first_name ?? "";
        $lastName = $this->last_name ?? "";

        return implode(' ', [$firstName, $lastName]);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class, 'customer_id');
    }
}
