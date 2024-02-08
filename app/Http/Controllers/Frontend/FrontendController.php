<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function error()
    {
        return view('error.403');
        // return view('error.404');
        // return view('error.500');
        // return view('error.503');
    }
}
