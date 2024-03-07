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
            $businessType->business_type_name = $request->name;
            $businessType->access = $request->access;
            $businessType->status = 'Active';
            $businessType->save();
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
