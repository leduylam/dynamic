<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account(){
        return view('dynamicsportsvn.customer.account');
    }
    public function historyOrder(){
        return view('dynamicsportsvn.customer.history');
    }
    public function historyDetail(){
        return view('dynamicsportsvn.customer.history_detail');
    }
}
