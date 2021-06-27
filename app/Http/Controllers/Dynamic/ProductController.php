<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('dynamicsportsvn.product.index');
    }

    public function tableProduct(){
        return view('dynamicsportsvn.product.table-product');
    }

    public function productDetail(){
        return view('dynamicsportsvn.product.product-detail.index');
    }
}
