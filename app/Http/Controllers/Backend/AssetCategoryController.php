<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BackendRequest\AssetCategoryRequest;
use App\Http\Resources\Backend\AssetCategoryResource;
use App\Models\AssetCategory;
use Illuminate\Support\Facades\DB;

class AssetCategoryController extends Controller
{
    //
    public function index()
    {
        return view('backend.asset.asset_category');
    }

    public function asset_category_list()
    {
        try {
            $asset_categories = AssetCategory::query()
                    // ->where()
                    ->when($request->status, fn($q) => $q->where('status', $request->status))
                    ->when($request->keyword, fn($q) => $q->where('asset_category_name', '%'.$request->keyword .'%'))
                    ->get():
            return AssetCategoryResource::collection($asset_categories);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

     public function store(AssetCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $asset_category = new AssetCategory();
            $asset_category->business_id = 1;
            $asset_category->asset_category_name = $request->name;
            $asset_category->status = 'Active';
            $asset_category->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Category Successfully Created",
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
            $asset_category = AssetCategory::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);
            return new AssetResource($asset_category);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

     public function update(AssetCategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $asset_category = new AssetCategory::query()
                // ->where()
                ->findOrFail($id);
            // $asset_category->business_id = 1;
            $asset_category->asset_category_name = $request->name;
            $asset_category->status = $request->name ? $request->name : $asset_category->status;
            $asset_category->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Category Successfully Updated",
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
            $asset_category = AssetCategory::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);

            $asset_category->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Category Successfully Deleted",
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
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
            $asset_category = Area::query()
                // ->where()
                ->findOrFail($id);
            if ($asset_category->status == 'Active') {
                $asset_category->status = 'Inactive';
            } else {
                $asset_category->status = 'Active';
            }
            $asset_category->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Category $asset_category->status Successfully Done",
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
