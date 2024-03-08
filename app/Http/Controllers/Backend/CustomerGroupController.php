<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Http\Resources\Backend\CustomerGroupResource;
use App\Http\Requests\BackendRequest\CustomerGroupRequest;
use Illuminate\Support\Facades\DB;

class CustomerGroupController extends Controller
{
    //
    public function index()
    {
        return view('backend.customer.group');
    }

    public function groupList(Request $request)
    {
        try {
            $customer_group = CustomerGroup::query()
                // ->where('business_id', 1)
                ->when($request->create_by, fn ($q) => $q->where('create_by', $request->create_by))
                ->when($request->keyword, fn ($q) => $q->where('name', 'like', '%' . $request->keyword . '%'))
                ->when($request->status, fn ($q) => $q->where('status', $request->status))
                ->get();
            return CustomerGroupResource::collection($customer_group);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(CustomerGroupRequest $request)
    {
        try {
            DB::beginTransaction();
            $customer_group = new CustomerGroup();
            $customer_group->business_id = 1;
            $customer_group->name = $request->name;
            $customer_group->amount = $request->amount;
            $customer_group->status = 'Active';
            $customer_group->create_by = backendUser()->id;
            $customer_group->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Customer Group Successfully Created",
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
            $customer_group = CustomerGroup::query()
                ->where('business_id', 1)
                ->findOrFail($id);
            return new CustomerGroupResource($customer_group);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(CustomerGroupRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $customer_group = CustomerGroup::findOrFail($id);
            // $customer_group->business_id = 1;
            $customer_group->name = $request->name;
            $customer_group->amount = $request->amount;
            $customer_group->status = $request->status ? $request->status : $customer_group->status;
            $customer_group->create_by = backendUser()->id;
            $customer_group->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Customer Group Successfully Updated",
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
            $customer_group = CustomerGroup::query()
                // ->where('business_id', 1)
                ->with('customers')
                ->findOrFail($id);

            if ($customer_group?->customers?->count() > 0) {
                return response()->json([
                    'status' => false,
                    'message' => "Group has has customer. You can not delete this group",
                ]);
            }

            $customer_group->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Customer Group Successfully Deleted",
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
            $customer_group = CustomerGroup::query()
                // ->where()
                ->findOrFail($id);
            if ($customer_group->status == 'Active') {
                $customer_group->status = 'Inactive';
            } else {
                $customer_group->status = 'Active';
            }
            $customer_group->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Customer Group $customer_group->status Successfully Done",
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
