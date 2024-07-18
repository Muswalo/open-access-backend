<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Login;

class LoginController extends Controller
{
    /**
     * Display a listing of the Logins.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logins = Login::all();

        return response()->json($logins);
    }
}
