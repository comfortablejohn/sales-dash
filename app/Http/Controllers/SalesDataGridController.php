<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesDataGridController extends Controller
{
    public function show()
    {
        return view('data-grid.show');
    }
}
