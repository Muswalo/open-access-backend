<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\SaleItem;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the SaleItems.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleItems = SaleItem::paginate();
        return response()->json($saleItems);
    }
}
