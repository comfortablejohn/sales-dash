<?php

namespace App\Http\Controllers\API;

use App\Customers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomersSearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(
            [
                's' => 'string|required'
            ]
        );
        $searchParam = $request->get('s');
        $customers = Customers::select(['id', 'first_name', 'last_name'])->searchByName($searchParam)->get();
        return response()->json($customers);
    }
}
