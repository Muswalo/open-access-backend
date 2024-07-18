<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the Reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();

        return response()->json($reports);
    }
}
