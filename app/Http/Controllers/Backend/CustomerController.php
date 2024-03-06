<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BackendRequest\CustomerRequest;
use App\Http\Resources\Backend\CustomerResource;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\InitialDue;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('backend.customer.index');
    }

    public function customerList(Request $request)
    {
        try {
            $customer = Customer::query()
                // ->where()
                ->with([
                    'customerInitialDue' => fn($q) => $q->select('id', 'business_id', 'customer_id', 'amount')->get(),
                ])
                ->get();
            return CustomerResource::collection($customer);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(CustomerRequest $request)
    {
        try {
            DB::beginTransaction();
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->member_ship_id = $request->member_ship_id;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->customer_group_id = $request->customer_group_id;
            $customer->date = $request->date ? $request->date : date('Y-m-d');
            $customer->area_id = $request->area_id;
            $customer->zip_code = $request->zip_code;
            $customer->address = $request->address;
            $customer->note = $request->note;
            $customer->status = 'Active';

            if ($request->hasFile("image")) {
                $image_url = imageUploader($request->file('image'), 'customer', $customer->image);
                $customer->image = $image_url;
            }

            $customer->save();

            if ($request->due && $request->due > 0) {
                $due = new InitialDue();
                $due->business_id = 1;
                $due->customer_id = $customer->id;
                $due->date = $request->date ? $request->date : date('Y-m-d');
                $due->amount = $request->due;
                $due->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User successfully Created',
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
            $customer = Customer::query()
                // ->where()
                ->findOrFail($id);
            return new CustomerResource($customer);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(CustomerRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::query()
                // ->where()
                ->findOrFail($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->member_ship_id = $request->member_ship_id;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->customer_group_id = $request->customer_group_id;
            $customer->date = $request->date ? $request->date : date('Y-m-d');
            $customer->area_id = $request->area_id;
            $customer->zip_code = $request->zip_code;
            $customer->address = $request->address;
            $customer->note = $request->note;
            $customer->status = 'Active';

            if ($request->hasFile("image")) {
                $image_url = imageUploader($request->file('image'), 'customer', $customer->image);
                $customer->image = $image_url;
            }

            $customer->save();

            if ($request->due && $request->due > 0) {
                $due = InitialDue::query()
                    // ->where()
                    ->where('customer_id', $customer->id)
                    ->first();
                $due->business_id = 1;
                $due->date = $request->date ? $request->date : date('Y-m-d');
                $due->amount = $request->due;
                $due->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User successfully updated',
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
            $customer = Customer::query()
                // ->where()
                ->findOrFail($id);
            return new CustomerResource($customer);
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
            $customer = Customer::query()
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
            $asset_category = Customer::query()
                // ->where()
                // ->withCount()
                ->findOrFail($id);

            fileUnlink($asset_category->image);

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
}
