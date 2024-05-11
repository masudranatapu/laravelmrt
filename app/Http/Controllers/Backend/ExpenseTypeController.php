<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\ExpenseTypeRequest;
use App\Http\Resources\BackendResource\ExpenseTypeResource;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        return view('backend.expense.expense_type');
    }

    public function dataList(Request $request)
    {
        try {
            $data = ExpenseType::query()
                ->where('business_id', Auth::user()->business_id)
                ->when($request->keyword, fn ($q) => $q->where('expense_type_name', 'like', '%' . $request->keyword . '%'))
                ->when($request->status, function ($q) use ($request) {
                    $q->where('status', $request->status);
                })
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
            return ExpenseTypeResource::collection($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(ExpenseTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $expenseType = new ExpenseType();
            $expenseType->business_id = Auth::user()->business_id;
            $expenseType->expense_type_name = $request->expense_type_name;
            $expenseType->sorting_number = $request->sorting_number;
            $expenseType->status = 'Active';
            $expenseType->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Expense Type Successfully Created",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $data = ExpenseType::query()
                ->findOrFail($id);
            return new ExpenseTypeResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(ExpenseTypeRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $expenseType = ExpenseType::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            $expenseType->expense_type_name = $request->expense_type_name;
            $expenseType->sorting_number = $request->sorting_number;
            $expenseType->status = $request->status ? $request->status : $expenseType->status;
            $expenseType->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Expense Type Successfully Updated",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function statusChange($id)
    {
        try {
            DB::beginTransaction();
            $expenseType = ExpenseType::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            if ($expenseType->status == 'Active') {
                $expenseType->status = 'Inactive';
            } else {
                $expenseType->status = 'Active';
            }
            $expenseType->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Expense Type $expenseType->status Successfully Done",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
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
                        'message' => 'Some Expense Type Used . You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Expense Type Successfully Deleted",
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
        $expenseType = ExpenseType::query()
            ->where('business_id', Auth::user()->business_id)
            ->findOrFail($id);

        $expenseType->delete();
        return true;
    }
}
