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

    public function asset_list(Request $request)
    {
        try {
            $assets = Asset::query()
                // ->where()
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->keyword, fn($q) => $q->where('asset_name', '%' . $request->keyword . '%'))
                ->get();
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

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $asset = Asset::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);

            $asset->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset Successfully Deleted",
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
            $asset = Asset::query()
                // ->where()
                ->findOrFail($id);
            if ($asset->status == 'Active') {
                $asset->status = 'Inactive';
            } else {
                $asset->status = 'Active';
            }
            $asset->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Asset $asset->status Successfully Done",
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
