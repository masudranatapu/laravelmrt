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

    public function assetCategoryList(Request $request)
    {
        try {
            $asset_categories = AssetCategory::query()
                // ->where()
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->keyword, fn($q) => $q->where('asset_category_name', 'like', '%' . $request->keyword . '%'))
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
            return AssetCategoryResource::collection($asset_categories);
        } catch (\Throwable $th) {
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
            $asset_category->asset_category_name = $request->asset_category_name;
            $asset_category->sorting_number = $request->sorting_number;
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
            return new AssetCategoryResource($asset_category);
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
            $asset_category = AssetCategory::query()
                // ->where()
                ->findOrFail($id);
            // $asset_category->business_id = 1;
            $asset_category->asset_category_name = $request->asset_category_name;
            $asset_category->status = $request->status ? $request->status : $asset_category->status;
            $asset_category->sorting_number = $request->sorting_number;
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
            $asset_category = AssetCategory::query()
                ->findOrFail($id);

            $asset_category->delete();
        return true;
    }


    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $asset_category = AssetCategory::query()
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
