<?php

namespace App\Http\Controllers;

use App\Sales;
use Carbon\Carbon;

class SalesDataGridController extends Controller
{
    public function show()
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $salesData = Sales::byDateRange($from, $to)->get();

        return view('data-grid.show', [
            'sales' => $salesData,
        ]);
    }
}
