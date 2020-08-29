<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public function sales()
    {
        return $this->hasMany(Sales::class, 'customer_id');
    }
}
