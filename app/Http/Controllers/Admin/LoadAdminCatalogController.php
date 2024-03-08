<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\Business\BusinessTraits;

class LoadAdminCatalogController extends Controller
{
    //
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
                // ->where()
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
}
