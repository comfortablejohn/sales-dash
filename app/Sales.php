<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

class Sales extends Model
{
    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    //====================================================================
    // Scopes
    //====================================================================

    public function scopeWithEmployeeName(Builder $query)
    {
        $query->with(['employee' => function ($query) {
            $query->select('id', 'name');
        }]);
    }

    public function scopeWithCustomerName(Builder $query)
    {
        $query->with(['customer' => function ($query) {
            $query->select('id', 'first_name');
        }]);
    }

    public function scopeByDateRange(Builder $query, Carbon $from, Carbon $to)
    {
        return $query
            ->where('date', '>=', $from->startOfDay())
            ->where('date', '<=', $to->endOfDay());
    }

    // this could just be replaced by relation on Employees maybe ($employee->sales->...)
    public function scopeByEmployee(Builder $query, Employees $employee)
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
