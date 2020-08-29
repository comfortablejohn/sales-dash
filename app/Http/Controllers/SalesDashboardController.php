<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesDashboardController extends Controller
{
    public function show()
    {
        return view('dashboard.show');
    }
}
