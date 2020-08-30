<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales;
use App\SalesStats;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsDaily extends Controller
{
    public function index(Request $request)
    {
        $request->validate(
            [
                'to' => 'date|date_format:Y-m-d',
                'from' => 'date|date_format:Y-m-d',
            ]
        );

        $to = $request->get('to');
        if (empty($to)) {
            $to = Carbon::now();
        } else {
            $to = Carbon::parse($to);
        }

        $from = $request->get('from');
        if (empty($from)) {
            $from = Carbon::now()->subMonth();
        } else {
            $from = Carbon::parse($from);
        }

        // get sales in date range
        $sales = Sales::orderBy('date', 'asc')->byDateRange($from, $to)->get();
        // get stats
        $totalsByDay = SalesStats::totalsByDay($sales);
        return response()->json($totalsByDay);
    }
}
