<?php

namespace App\Http\Controllers\API;

use App\Customers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomersSearchResource;
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
        // decode any spaces or special characters
        $searchParam = urldecode($request->get('s'));
        $customers = Customers::select(['id', 'first_name', 'last_name'])->searchByName($searchParam)->get();
        return response()->json(CustomersSearchResource::collection($customers));
    }
}
