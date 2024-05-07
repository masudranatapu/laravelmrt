<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BackendRequest\AssetRequest;
use App\Http\Resources\Backend\AssetResource;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    //
    public function index()
    {
        return view('backend.asset.index');
    }

    public function assetsList(Request $request)
    {
        try {
            $assets = Asset::query()
                // ->where()
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->keyword, fn($q) => $q->where('asset_name', 'like', '%' . $request->keyword . '%'))
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
            return AssetResource::collection($assets);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(AssetRequest $request)
    {
        try {
            DB::beginTransaction();
            $asset = new Asset();
            $asset->business_id = 1;
            $asset->asset_id = $request->asset_id;
            $asset->account_id = $request->account_id;
            $asset->pay_by = $request->pay_by;
            $asset->date = date('Y-m-d', strtotime($request->date));
            $asset->amount = $request->amount;
            $asset->sorting_number = $request->sorting_number;
            $asset->note = $request->note;
            $asset->status = 'Active';
            $asset->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Asset Successfully Created",
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
            $assets = Asset::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);
            return new AssetResource($assets);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(AssetRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $asset = Asset::query()
                // ->where()
                ->findOrFail($id);
            $asset->business_id = 1;
            $asset->asset_id = $request->asset_id;
            $asset->account_id = $request->account_id;
            $asset->pay_by = $request->pay_by;
            $asset->date = date('Y-m-d', strtotime($request->date));
            $asset->amount = $request->amount;
            $asset->note = $request->note;
            $asset->status = $request->status ? $request->status : $asset->status;
            $asset->sorting_number = $request->sorting_number;
            $asset->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Successfully Updated",
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
            $asset = Asset::query()
                ->findOrFail($id);

            $asset->delete();
            return true;
    }
}
