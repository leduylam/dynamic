<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class LoginController extends Controller
{
    public function login()
    {
        $categories = Category::get();
        return view('dynamicsportsvn.customer.login', compact('categories'));
    }
}
