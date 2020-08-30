<?php

namespace App\Http\Controllers;

use App\Sales;
use App\SalesStats;
use Carbon\Carbon;

class SalesDashboardController extends Controller
{
    public function show()
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $sales = Sales::byDateRange($from, $to)->orderBy('date', 'asc')->get();

        $totalsByDay = SalesStats::totalsByDay($sales);
        return view('dashboard.show', [
            'totals_by_day' => $totalsByDay,
            'from_date' => $from->format('Y-m-d'),
            'to_date' => $to->format('Y-m-d'),
        ]);
    }
}
