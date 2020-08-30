<?php

namespace App\Http\Controllers\API;

use App\Sales;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // should break this out into Validation class
        $request->validate(
            [
                'page' => 'int',
                'to' => 'date|before_or_equal:today|date_format:Y-m-d',
                'from' => 'date|before_or_equal:to|date_format:Y-m-d',
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

        $sales = $query->orderBy('date', 'desc')->paginate(100);
        return response()->json($sales);
    }
}
