<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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

            $user = User::where("id", $id)->first();

            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
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
            $user = User::where('id', $id)->first();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->country = $request->country;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $user->gender = $request->gender;
            $user->bio = $request->bio;
            $user->save();
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
