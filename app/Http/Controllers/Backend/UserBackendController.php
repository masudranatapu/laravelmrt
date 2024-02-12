<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBackendController extends Controller
{
    //
    public function index()
    {
        return view("backend.user.profile");
    }
    public function info()
    {
        try {
            $user = User::where("id", Auth::user()->id)->first();
            return response()->json($user);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    public function passwordUpdate(PasswordUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            DB::commit();
            return response()->json([
                "message" => "done"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage());
        }
    }
}
