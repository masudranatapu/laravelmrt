<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BackendRequest\AreaRequest;
use App\Http\Resources\BackendResource\AreaResource;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    //
    public function index()
    {
        return view('backend.area.index');
    }

    public function areaList(Request $request)
    {
        try {
            $areas = Area::query()
                // ->where('bu')
                ->when($request->keyword, fn ($q) => $q->where('name', 'like', '%' . $request->keyword . '%'))
                ->when($request->status, fn ($q) => $q->where('status', $request->status))
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
            return AreaResource::collection($areas);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function store(AreaRequest $request)
    {
        try {
            DB::beginTransaction();
            $area = new Area();
            $area->business_id = 1;
            $area->name = $request->name;
            $area->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
            $area->status = 'Active';
            $area->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Area Successfully Created",
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
            $areas = Area::query()
                // ->where('bu')
                ->findOrFail($id);
            return new AreaResource($areas);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(AreaRequest $request, $id)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $area = Area::query()
                // ->where()
                ->findOrFail($id);
            $area->business_id = 1;
            $area->name = $request->name;
            $area->status = $request->status ? $request->status : $area->status;
            $area->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
            $area->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Area Successfully Updated",
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
                        'message' => 'Business Type Some Issue. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Business Type Successfully Deleted",
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
        $area = Area::query()
            ->findOrFail($id);
        $area->delete();
        return true;
    }

    public function statusChange($id)
    {
        try {
            DB::beginTransaction();
            $area = Area::query()
                // ->where()
                ->findOrFail($id);
            if ($area->status == 'Active') {
                $area->status = 'Inactive';
            } else {
                $area->status = 'Active';
            }
            $area->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Area $area->status Successfully Done",
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
