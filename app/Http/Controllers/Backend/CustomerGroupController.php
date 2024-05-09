<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Http\Resources\BackendResource\CustomerGroupResource;
use App\Http\Requests\BackendRequest\CustomerGroupRequest;
use Illuminate\Support\Facades\Auth;
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
                ->where('business_id', Auth::user()->business_id)
                ->when($request->create_by, fn ($q) => $q->where('create_by', $request->create_by))
                ->when($request->keyword, fn ($q) => $q->where('name', 'like', '%' . $request->keyword . '%'))
                ->when($request->status, fn ($q) => $q->where('status', $request->status))
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
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
            $customer_group->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
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
                ->where('business_id', Auth::user()->business_id)
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
            $customer_group = CustomerGroup::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            $customer_group->name = $request->name;
            $customer_group->amount = $request->amount;
            $customer_group->status = $request->status ? $request->status : $customer_group->status;
            $customer_group->create_by = backendUser()->id;
            $customer_group->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
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
                        'message' => 'Customer Some Issue. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Customer Successfully Deleted",
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
        $customer_group = CustomerGroup::query()
            ->where('business_id', Auth::user()->business_id)
            ->with('customers')
            ->findOrFail($id);

        if ($customer_group?->customers?->count() > 0) {
            return false;
        }

        $customer_group->delete();
        return true;
    }

    public function statusChange($id)
    {
        try {
            DB::beginTransaction();
            $customer_group = CustomerGroup::query()
                ->where('business_id', Auth::user()->business_id)
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
