<?php

namespace App\Http\Controllers\API;

use App\Customers;
use App\Employees;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomersSearchResource;
use Illuminate\Http\Request;

class EmployeesSearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(
            [
                's' => 'string|required'
            ]
        );
        $searchParam = $request->get('s');
        $employees = Employees::select(['id', 'name'])->searchByName($searchParam)->get();
        return response()->json($employees);
    }
}
