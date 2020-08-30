<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeSearchByName(Builder $query, string $searchString)
    {
        $upperCaseString = trim(strtoupper($searchString));
        return $query->whereRaw("UPPER(customers.first_name) LIKE '%" . $upperCaseString . "%'")
            ->orWhereRaw("UPPER(customers.last_name) LIKE '%" . $upperCaseString . "%'");
    }
}
