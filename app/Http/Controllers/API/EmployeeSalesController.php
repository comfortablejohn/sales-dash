<?php

namespace App\Http\Controllers\API;

use App\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeSalesController extends Controller
{
    public function index(Employees $employee)
    {
        $sales = $employee->sales;
        return response()->json($sales);
    }
}
