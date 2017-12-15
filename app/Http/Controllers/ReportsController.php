<?php

namespace App\Http\Controllers;

use App\Jobs\CompileReports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    function report(Request $request)
    {
    	$job = new CompileReports($request->reportId, $request->type);

    	$this->dispatch( $job );

    	return 'Done';
    }
}
