<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;

class ReportController extends Controller
{
    // Revenue report by Category
    public function categoryReport(){
        $categories = Category::with('parentId1')->get();
        
        $categories = json_decode($categories);
        // echo "<pre>"; print_r($categories); die;
        return view('backend.report.category-report.index', compact('categories'));
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
