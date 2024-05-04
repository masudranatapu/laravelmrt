<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use App\Models\PricingPlan;
use App\Traits\Business\BusinessTraits;

class LoadAdminCatalogController extends Controller
{
    use BusinessTraits;

    public function loadBusinessOption()
    {
        try {
            $accessOptions = $this->businessOptions();
            return response()->json($accessOptions);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function loadAdminUsers()
    {
        try {
            $adminUsers = Admin::query()
                ->select('id', 'name')
                ->get();
            return response()->json($adminUsers);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function pricingPlan($id)
    {
        try {
            $pricingPlan = PricingPlan::query()
                ->select('id', 'month', 'discount_type', 'discount_value')
                ->findOrFail($id);
            return response()->json($pricingPlan);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function packageInfo($id)
    {
        try {
            $package = Package::query()
                ->select('id', 'monthly_service_charge', 'installment_fee', 'user_limit', 'product_limit', 'branch_limit')
                ->findOrFail($id);
            return response()->json($package);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
