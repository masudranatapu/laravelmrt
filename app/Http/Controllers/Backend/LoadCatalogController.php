<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\AreaResource;
use App\Http\Resources\Backend\CustomerGroupResource;
use App\Models\Area;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class LoadCatalogController extends Controller
{
    //
    public function loadGroup()
    {
        try {
            $groups = CustomerGroup::query()
                // ->where()
                ->where('status', 'Active')
                ->get();
            return CustomerGroupResource::collection($groups);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function loadArea()
    {
        try {
            $areas = Area::query()
                // ->where()
                ->where('status', 'Active')
                ->get();
            return AreaResource::collection($areas);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
