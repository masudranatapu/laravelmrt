<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\BackendResource\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('backend.brand.index');
    }

    public function brandList(Request $request)
    {
        try {
            $brand = Brand::query()
                ->paginate($request->per_page ?? 10);
            return BrandResource::collection($brand);
        } catch (\Throwable $e) {

        }
    }
}
