<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\BackendResource\AreaResource;
use App\Http\Resources\BackendResource\AssetCategoryResource;
use App\Http\Resources\BackendResource\CustomerGroupResource;
use App\Models\Area;
use App\Models\AssetCategory;
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

    public function loadAssetCategory()
    {
        try {
            $asset_category = AssetCategory::query()
                // ->where()
                ->get();
            return AssetCategoryResource::collection($asset_category);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function accountTypesList()
    {
        $accountsTypes = accountTypes();
        return response()->json($accountsTypes);
    }
    public function mobileBankingLIst()
    {
        $mobileAccounts = mobileBankingNames();
        return response()->json($mobileAccounts);
    }
}
