<?php

namespace App\Http\Controllers\API;

use App\Customers;
use App\Http\Controllers\Controller;

class CustomerSalesController extends Controller
{
    public function index(Customers $customer)
    {
        $sales = $customer->sales;
        return response()->json($sales);
    }
}
