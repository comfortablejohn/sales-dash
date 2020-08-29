<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function sales()
    {
        return $this->hasMany(Sales::class, 'product_id');
    }
}
