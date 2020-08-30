<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public function sales()
    {
        return $this->hasMany(Sales::class, 'employee_id');
    }

    public function scopeSearchByName(Builder $query, string $searchString)
    {
        $upperCaseString = trim(strtoupper($searchString));
        return $query->whereRaw("UPPER(name) LIKE '%" . $upperCaseString . "%'");
    }
}
