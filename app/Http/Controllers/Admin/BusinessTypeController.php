<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\BusinessTypeRequest;
use App\Http\Resources\Admin\BusinessTypeResource;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessTypeController extends Controller
{
    //
    public function index()
    {
        return view("admin.business_type.index");
    }

    function businessTypeList(Request $request)
    {
        try {
            $businessTypes = BusinessType::query()
                // ->where("",1)
                ->when($request->keyword, fn ($q) => $q->where("name", "LIKE", "%" . $request->keyword . "%"))
                ->when($request->status, fn ($q) => $q->where("status", $request->status))
                ->get();

            return BusinessTypeResource::collection($businessTypes);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(BusinessTypeRequest $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $businessType = new BusinessType();
            $businessType->business_type_name = $request->business_type_name;
            $businessType->access = $request->access;
            $businessType->status = 'Active';
            $businessType->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Business Type Successfully Created',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $businessType = BusinessType::query()
                ->findOrFail($id);
            return new BusinessTypeResource($businessType);
        } catch (\Throwable $th) {
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
            $businessType = BusinessType::query()
                ->findOrFail($id);

            $businessType->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Business Type Successfully Deleted",
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(BusinessTypeRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $businessType = BusinessType::query()
                ->findOrFail($id);
            $businessType->business_type_name = $request->business_type_name;
            $businessType->access = $request->access;
            $businessType->status = 'Active';
            $businessType->save();
            DB::commit();
            return response()->json([
                'status' => false,
                'message' => 'Business Type Successfully Updated',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function statusChange($id)
    {
        try {
            DB::beginTransaction();
            $businessType = BusinessType::query()
                ->findOrFail($id);
            if ($businessType->status == 'Active') {
                $businessType->status = 'Inactive';
            } else {
                $businessType->status = 'Active';
            }
            $businessType->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Business Type $businessType->status Successfully Done",
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
