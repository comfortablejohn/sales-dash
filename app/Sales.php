<?php

namespace App;

use Cassandra\Custom;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    //====================================================================
    // Scopes
    //====================================================================

    public function scopeByDateRange($query, $from, $to)
    {
        return $query->where('date', '>=', $from)->where('date', '<=', $to)->orderBy('date', 'desc');
    }

    // this could just be replaced by relation on Employees maybe ($employee->sales->...)
    public function scopeByEmployee($query, Employees $employee)
    {
        return $query->where('employee_id', $employee->id);
    }

    //====================================================================
    // Relations
    //====================================================================

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
