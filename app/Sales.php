<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $dates = [
        'date',
    ];

    public function scopeByDateRange($query, $from, $to)
    {
        return $query->where('date', '>=', $from)->where('date', '<=', $to)->orderBy('date', 'desc');
    }

    // this could just be replaced by relation on Employees maybe ($employee->sales->...)
    public function scopeByEmployee($query, Employees $employee)
    {
        return $query->where('employee_id', $employee->id);
    }
}
