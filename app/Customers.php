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
        $wildCarded = "%$upperCaseString%";
        $query->whereRaw("UPPER(CONCAT(customers.first_name, ' ', customers.last_name)) LIKE ?", $wildCarded)->toSql();
    }
}
