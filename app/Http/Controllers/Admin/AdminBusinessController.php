<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Http\Resources\Admin\AdminBusinessResource;

class AdminBusinessController extends Controller
{
    //
    public function index()
    {
        return view("admin.business.index");
    }

    public function businessList(Request $request)
    {
        try {
            $par_page = $request->per_page ?? 10;
            $business = Business::query()
                // ->when()
                ->latest()
                ->paginate($par_page);
            return AdminBusinessResource::collection($business);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function create()
    {
        return view("admin.business.create");
    }


    public function store()
    {

    }
}
