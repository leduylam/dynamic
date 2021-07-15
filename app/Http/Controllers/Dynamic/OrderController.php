<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('dynamicsportsvn.cart.index');
    }
    public function checkout(){
        return view('dynamicsportsvn.cart.checkout');
    }
}
