<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DynamicSportController extends Controller
{
    public function home(){
        return view('welcome');
    }
}
