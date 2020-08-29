<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public function sales()
    {
        return $this->hasMany(Sales::class, 'employee_id');
    }
}
