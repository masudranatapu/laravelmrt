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
    public function index()
    {
        return view("admin.package.index");
    }

    public function dataList(Request $request)
    {
        try {
            $packages = Package::query()
                ->when($request->start_date || $request->end_date, fn ($q) => $q->whereBetween("created_at", [$request->start_date, $request->end_date]))
                ->when($request->keyword, fn ($q) => $q->where("title", "LIKE", "%" . $request->keyword . "%"))
                ->latest()
                ->paginate($request->per_page ?? 10);
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
            $package->monthly_service_charge = $request->monthly_service_charge;
            $package->installment_fee = $request->installment_fee;
            $package->user_limit = $request->user_limit;
            $package->product_limit = $request->product_limit;
            $package->branch_limit = $request->branch_limit;
            $package->customer_limit = $request->customer_limit;
            $package->supplier_limit = $request->supplier_limit;
            $package->description = $request->description;
            $package->admin_id = adminUser()->id;
            $package->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
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
            $package->monthly_service_charge = $request->monthly_service_charge;
            $package->installment_fee = $request->installment_fee;
            $package->user_limit = $request->user_limit;
            $package->product_limit = $request->product_limit;
            $package->customer_limit = $request->customer_limit;
            $package->branch_limit = $request->branch_limit;
            $package->supplier_limit = $request->supplier_limit;
            $package->description = $request->description;
            $package->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
            $package->admin_id = adminUser()->id;
            $package->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Package Successfully Updated',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                $deleteData = $this->destroy($id);
                if ($deleteData != true) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Package Some Issue. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Package Successfully Deleted",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $package = Package::query()
            ->findOrFail($id);
        $package->delete();
        return true;
    }
}
