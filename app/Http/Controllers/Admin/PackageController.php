<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\PackageRequest;
use App\Http\Resources\Admin\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    //
    public function index()
    {
        return view("admin.package.index");
    }
    public function packageList(Request $request)
    {
        try {
            $packages = Package::query()
                // ->when()
                ->latest()
                ->get();
            return PackageResource::collection($packages);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function store(PackageRequest $request)
    {
        try {
            DB::beginTransaction();
            $package = new Package();
            $package->title = $request->title;
            $package->price = $request->price;
            $package->installment_fee = $request->installment_fee;
            $package->user_limit = $request->user_limit;
            $package->product_limit = $request->product_limit;
            $package->description = $request->description;
            $package->setting_access = $request->setting_access ? json_encode($request->setting_access) : [];
            $package->admin_id = adminUser()->id;
            $package->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Package Successfully Created',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $package = Package::query()
                ->findOrFail($id);
            return new PackageResource($package);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(PackageRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $package = Package::query()
                ->findOrFail($id);
            $package->title = $request->title;
            $package->price = $request->price;
            $package->installment_fee = $request->installment_fee;
            $package->user_limit = $request->user_limit;
            $package->product_limit = $request->product_limit;
            $package->description = $request->description;
            $package->setting_access = $request->setting_access ? json_encode($request->setting_access) : $package->setting_access;
            $package->admin_id = adminUser()->id;
            $package->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Package Successfully Created',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $package = Package::query()
                ->findOrFail($id);
            $package->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
