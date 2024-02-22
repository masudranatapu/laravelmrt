<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBusinessController extends Controller
{
    //
    public function index()
    {
        return view("admin.businesse.index");
    }

    public function create()
    {
        return view("admin.businesse.create");
    }
}
