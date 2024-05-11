<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\ExpenseRequest;
use App\Http\Resources\BackendResource\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('backend.expense.index');
    }

    public function list(Request $request)
    {
        $expense_type_id = isset($request->expense_type['id']) ? $request->expense_type['id'] : null;

        try {
            $data = Expense::query()
                ->where('business_id', Auth::user()->business_id)
                ->when($request->account_id, fn ($q) => $q->where('account_id', $request->account_id))
                ->when($request->account_type, fn ($q) => $q->where('pay_by', $request->account_type))
                ->when($expense_type_id, fn ($q) => $q->where('expense_type_id', $expense_type_id))
                ->when($request->start_date, fn ($q) => $q->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date))))
                ->when($request->end_date, fn ($q) => $q->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date))))
                ->orderBy('sorting_number', $request->sort_order)
                ->paginate($request->per_page ?? 10);
            return ExpenseResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(ExpenseRequest $request)
    {
        try {
            DB::beginTransaction();
            $expense = new Expense();
            $expense->business_id = Auth::user()->business_id;
            $expense->user_id = auth()->user()->id;
            $expense->expense_type_id = isset($request->type['id']) ? $request->type['id'] : null;
            $expense->account_id = $request->account_id;
            $expense->pay_by = $request->account_type;
            $expense->date = $request->date ?? date("Y-m-d");
            $expense->amount = $request->amount ?? 0;
            $expense->note = $request->note;
            // $expense->ck_number = $request->ck_number;
            // $expense->ck_issue_date = $request->ck_issue_date;
            // $expense->ck_active_date = $request->ck_active_date;
            // $expense->ck_issue_name = $request->ck_issue_name;
            // $expense->ck_bank_name = $request->ck_bank_name;
            $expense->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Expense successfully Created',
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
            $data = Expense::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            return new ExpenseResource($data);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function update(ExpenseRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $expense = Expense::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            $expense->expense_type_id = isset($request->type['id']) ? $request->type['id'] : null;
            $expense->account_id = $request->account_id;
            $expense->pay_by = $request->account_type;
            $expense->date = $request->date ?? date("Y-m-d");
            $expense->amount = $request->amount ?? 0;
            $expense->note = $request->note;
            // $expense->ck_number = $request->ck_number;
            // $expense->ck_issue_date = $request->ck_issue_date;
            // $expense->ck_active_date = $request->ck_active_date;
            // $expense->ck_issue_name = $request->ck_issue_name;
            // $expense->ck_bank_name = $request->ck_bank_name;
            $expense->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Expense successfully Updated',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function show($id)
    {
        try {
            $data = Expense::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            return new ExpenseResource($data);
        } catch (\Throwable $th) {
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
                        'message' => 'Some Expense Has Due. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Expenses Successfully Deleted",
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
        $data = Expense::query()
            ->where('business_id', Auth::user()->business_id)
            ->findOrFail($id);
        $data->delete();
        return true;
    }
}
