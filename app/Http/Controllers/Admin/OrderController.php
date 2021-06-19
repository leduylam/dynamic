<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('backend.order.index');
    }


    public function create(){
        return view('backend.order.create');
    }
}
