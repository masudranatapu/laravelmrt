<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\PasswordUpdateRequest;
use App\Http\Requests\BackendRequest\UserProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    function dashboard()
    {
        return view('admin.index');
    }

    function profile()
    {
        return view('admin.profile.index');
    }

    public function info()
    {
        try {
            $admin = Admin::where("id", Auth::user()->id)->first();
            return response()->json($admin);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    public function passwordUpdate(PasswordUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $admin = Admin::where("id", $id)->first();

            if (Hash::check($request->old_password, $admin->password)) {
                $admin->password = Hash::make($request->password);
                $admin->save();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Password not match',
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Password successfully updated',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function profileUpdate(UserProfileUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::where('id', $id)->first();
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->country = $request->country;
            $admin->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $admin->gender = $request->gender;
            $admin->bio = $request->bio;
            $admin->save();
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
}
