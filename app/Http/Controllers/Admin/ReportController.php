<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Revenue report by Category
    public function categoryReport(){
        return view('backend.report.category-report.index');
    }
    public function showCategoryReport(){
        return view('backend.report.category-report.show');
    }


    // Revenue report by customer
    public function index(){
        return view('backend.report.customer-report.index');
    }
    public function show(){
        return view('backend.report.customer-report.show');
    }




    //Sales report by item

    public function detailedReport(){
        return view('backend.report.detailed-report.index');
    }
}
