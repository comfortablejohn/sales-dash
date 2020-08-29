<?php

namespace App\Http\Controllers\API;

use App\Sales;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::orderBy('date', 'desc')->get();
        return response()->json($sales);
    }
}
