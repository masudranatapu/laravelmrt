<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function project()
    {
        return view('frontend.project.index');
    }

    public function projectDetails()
    {
        return view('frontend.project.details');
    }
}
