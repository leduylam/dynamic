<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function listCustomer()
    {
        // $admins = Admin::all();

        return view('backend.customer.index');
    }

    public function create()
    {
        return view('backend.customer.create');
    }
}
