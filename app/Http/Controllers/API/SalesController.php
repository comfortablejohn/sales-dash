<?php

namespace App\Http\Controllers\API;

use App\Sales;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // should break this out into Validation class
        $request->validate(
            [
                'page' => 'int',
                'employee' => 'exists:App\Employees,id',
                'customer' => 'exists:App\Customers,id',
                'to' => 'date|date_format:Y-m-d',
                'from' => 'date|date_format:Y-m-d',
            ]
        );

        $query = Sales::with(["employee:id,name","customer:id,first_name,last_name","product:id,name"]);

        if ($request->has('from')) {
            $from = Carbon::parse($request->get('from'));
            $query->where('date', '>=', $from->startOfDay());
        }

        if ($request->has('to')) {
            $to = Carbon::parse($request->get('to'));
            $query->where('date', '<=', $to->endOfDay());
        }

        if ($request->has('employee')) {
            $query->where('employee_id', $request->get('employee'));
        }

        if ($request->has('customer')) {
            $query->where('customer_id', $request->get('customer'));
        }

        $sales = $query->orderBy('date', 'desc')->paginate(100);
        return response()->json($sales);
    }
}
