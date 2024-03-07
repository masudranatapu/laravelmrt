<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\SupplierRequest;
use App\Http\Resources\Backend\SupplierResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\InitialDue;

class SupplierController extends Controller
{
    //
    public function index()
    {
        return view('backend.supplier.index');
    }

    public function supplierList(Request $request)
    {
        try {
            $customer = Supplier::query()
                // ->where()
                ->with([
                    'supplierInitialDue' => fn($q) => $q->select('id', 'business_id', 'customer_id', 'amount')->get(),
                ])
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->get();
            return SupplierResource::collection($customer);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }

    }
    public function store(SupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $supplier = new Supplier();
            $supplier->business_id = 1;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->supplier_business_name = $request->supplier_business_name;
            $supplier->phone = $request->phone;
            $supplier->gender = $request->gender;
            $supplier->date_of_birth = $request->date_of_birth;
            $supplier->date = $request->date ? $request->date : date('Y-m-d');
            $supplier->area_id = $request->area_id;
            $supplier->zip_code = $request->zip_code;
            $supplier->address = $request->address;
            $supplier->note = $request->note;
            $supplier->status = 'Active';

            if ($request->hasFile("image")) {
                $image_url = imageUploader($request->file('image'), 'supplier', $supplier->image);
                $supplier->image = $image_url;
            }

            $supplier->save();

            if ($request->due && $request->due > 0) {
                $due = new InitialDue();
                $due->business_id = 1;
                $due->supplier_id = $supplier->id;
                $due->date = $request->date ? $request->date : date('Y-m-d');
                $due->amount = $request->due;
                $due->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Supplier successfully Created',
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
            $customer = Supplier::query()
                // ->where()
                ->findOrFail($id);
            return new SupplierResource($customer);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function update(SupplierRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::query()
                // ->where()
                ->findOrFail($id);
            $supplier->business_id = 1;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->supplier_business_name = $request->supplier_business_name;
            $supplier->phone = $request->phone;
            $supplier->gender = $request->gender;
            $supplier->date_of_birth = $request->date_of_birth;
            $supplier->date = $request->date ? $request->date : date('Y-m-d');
            $supplier->area_id = $request->area_id;
            $supplier->zip_code = $request->zip_code;
            $supplier->address = $request->address;
            $supplier->note = $request->note;

            if ($request->hasFile("image")) {
                $image_url = imageUploader($request->file('image'), 'supplier', $supplier->image);
                $supplier->image = $image_url;
            }

            $supplier->save();

            if ($request->due && $request->due > 0) {
                $due = InitialDue::query()
                    // ->where()
                    ->where('supplier_id', $supplier->id)
                    ->first();
                $due->business_id = 1;
                $due->supplier_id = $supplier->id;
                $due->date = $request->date ? $request->date : date('Y-m-d');
                $due->amount = $request->due;
                $due->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Supplier successfully Updated',
            ]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function view($id)
    {
        try {
            $customer = Supplier::query()
                // ->where()
                ->findOrFail($id);
            return new SupplierResource($customer);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }

    }
    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $request = request();
            $customer = Supplier::query()
                // ->where()
                ->findOrFail($id);
            $customer->status = $request->status;
            $customer->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Customer $customer->status Successfully Done",
            ]);
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
            $supplier = Supplier::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);

            fileUnlink($supplier->image);

            $supplier->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Supplier Successfully Deleted",
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
