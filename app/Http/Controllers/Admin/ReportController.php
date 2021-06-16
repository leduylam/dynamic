<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function orderReport(){
        return view('backend.report.order-report.index');
    }
    public function customerReport(){
        return view('backend.report.customer-report.index');
    }
    public function detailedReport(){
        return view('backend.report.detailed-report.index');
    }
}
