<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\AccountRequest;
use App\Http\Resources\BackendResource\AccountResource;
use Illuminate\Http\Request;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        return view('backend.account.index');
    }

    public function list(Request $request)
    {
        $date = Carbon::parse($request->start_date ?? date('Y-m-d'))->addDays(1)->format('Y-m-d');
        $deduactable = ['sales', 'purchase_returns', 'customer_due_receive', 'supplier_due_receive', 'customer_advance_payments', 'dress_orders_advance_payments'];

        try {
            $data['mobile_bankings'] = Account::query()
                ->where('business_id', Auth::user()->business_id)
                ->where('account_type', 'Mobile Banking')
                ->withCount([
                    "ledger as debit_amount" => fn ($q) => $q->where("date", "<", $date)->select(DB::raw("sum(debit_amount)")),
                    "ledger as credit_amount" => fn ($q) => $q->where("date", "<", $date)->select(DB::raw("sum(credit_amount)")),
                    "ledger as dedact_able_amount" => fn ($q) => $q->whereIn('type', $deduactable)->where("date", "<", $date)->select(DB::raw("sum(debit_amount)")),
                ])
                ->addSelect([
                    'balance' => function ($q) {
                        $q->selectRaw(
                            "COALESCE(debit_amount,0)"
                                . "-COALESCE(credit_amount,0)"
                        );
                    }
                ])
                ->get()->map(function ($data) use ($request) {
                    $charge  = ($data->dedact_able_amount  / 100) * $data->pm_charge;
                    $data->charge = $charge;
                    $data->balance = ($data->balance) - $charge;
                    return $data;
                });

            $data['cash_account'] = Account::query()
                ->where('business_id', Auth::user()->business_id)
                ->where('account_type', 'Cash')
                ->withCount([
                    "ledger as debit_amount" => fn ($q) => $q->where("date", "<", $date)->select(DB::raw("sum(debit_amount)")),
                    "ledger as credit_amount" => fn ($q) => $q->where("date", "<", $date)->select(DB::raw("sum(credit_amount)")),
                    "ledger as dedact_able_amount" => fn ($q) => $q->whereIn('type', $deduactable)->where("date", "<", $date)->select(DB::raw("sum(debit_amount)")),
                ])
                ->addSelect([
                    'balance' => function ($q) {
                        $q->selectRaw(
                            "COALESCE(debit_amount,0)"
                                . "-COALESCE(credit_amount,0)"
                        );
                    }
                ])
                ->get()->map(function ($data) use ($request) {
                    $charge  = ($data->dedact_able_amount  / 100) * $data->pm_charge;
                    $data->charge = $charge;
                    $data->balance = ($data->balance) - $charge;
                    return $data;
                })->first();

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function store(AccountRequest $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();
            $account = new Account();
            $account->business_id = Auth::user()->business_id;
            $account->account_type = $request->account_type;
            $account->mobile_bank_name = $request->mobile_bank_name;
            $account->mobile_number = $request->mobile_number;
            $account->pm_charge = $request->pm_charge ?? 0;
            // $account->bank_list_id = $request->bank_list_id;
            // $account->bank_account_type = $request->bank_account_type;
            // $account->bank_account_name = $request->bank_account_name;
            // $account->bank_account_number = $request->bank_account_number;
            // $account->bank_account_branch = $request->bank_account_branch;
            // $account->card_type = $request->card_type;
            // $account->card_holder_name = $request->card_holder_name;
            // $account->card_number = $request->card_number;
            $account->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Account successfully Created',
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
            $data = Account::query()
                ->findOrFail($id);
            return new AccountResource($data);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function update(AccountRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $account = Account::query()
                ->where('business_id', Auth::user()->business_id)
                ->findOrFail($id);
            $account->type = $request->type;
            $account->mobile_bank_name = $request->mobile_bank_name;
            $account->mobile_number = $request->mobile_number;
            $account->pm_charge = $request->pm_charge ?? 0;
            // $account->bank_list_id = $request->bank_list_id;
            // $account->bank_account_type = $request->bank_account_type;
            // $account->bank_account_name = $request->bank_account_name;
            // $account->bank_account_number = $request->bank_account_number;
            // $account->bank_account_branch = $request->bank_account_branch;
            // $account->card_type = $request->card_type;
            // $account->card_holder_name = $request->card_holder_name;
            // $account->card_number = $request->card_number;
            $account->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Account successfully Updated',
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
            $data = Account::query()->findOrFail($id);
            return new AccountResource($data);
        } catch (\Throwable $th) {
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
            $data = Account::query()->findOrFail($id);
            if ($data->status == 'Active') {
                $data->status = 'Inactive';
            } else {
                $data->status = 'Active';
            }
            $data->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Account $data->status Successfully Done",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function bulkDelete(Request $request)
    {
        dd('bulkDelete ');
        // try {
        //     DB::beginTransaction();
        //     $ids = explode(',', $request->ids);
        //     foreach ($ids as $id) {
        //         $deleteData = $this->destroy($id);
        //         if ($deleteData != true) {
        //             DB::rollBack();
        //             return response()->json([
        //                 'status' => false,
        //                 'message' => 'Some Account Has Due. You Can not continue This Action',
        //             ]);
        //         }
        //     }

        //     DB::commit();

        //     return response()->json([
        //         'status' => true,
        //         'message' => "Accounts Successfully Deleted",
        //     ]);

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->json([
        //         'status' => false,
        //         'message' => $e->getMessage(),
        //     ]);
        // }
    }

    public function destroy($id)
    {
        $supplier = Account::query()->findOrFail($id);
        $supplier->delete();
        return true;

        // if (!$supplier->isDeletable()) {
        //     return false;
        // } else {
        //     $supplier->delete();
        //     return true;
        // }
    }
}
