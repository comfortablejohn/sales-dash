<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::orderBy('date', 'desc')->get();
        return response()->json($sales);
    }
}
