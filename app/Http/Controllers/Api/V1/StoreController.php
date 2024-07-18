<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the Stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Store::all();

        return response()->json($users);
    }
}
