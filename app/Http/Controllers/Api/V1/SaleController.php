<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the Sales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return response()->json($sales);
    }
}
