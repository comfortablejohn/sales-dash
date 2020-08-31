<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function scopeWithCustomerNames(Builder $query)
    {
        // need to make select explicit now
        $query
            ->select('sales.id','customer_id','product_id','employee_id','date','invoice_id')
            ->addSelect(DB::raw("customers.first_name as customer_first_name, customers.last_name as customer_last_name"))
            ->leftJoin('customers', 'customers.id', 'customer_id');
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
