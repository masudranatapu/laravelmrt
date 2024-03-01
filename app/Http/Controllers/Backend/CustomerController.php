<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BackendRequest\CustomerRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('backend.customer.index');    
    }

    public function customerList(Request $request)
    {
        $customer = Customer::get();
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
            $customer->due = $request->due;
            $customer->customer_group_id = $request->customer_group_id;
            $customer->date = $request->date;
            $customer->area = $request->area;
            $customer->country = $request->country;
            $customer->zip_code = $request->zip_code;
            $customer->address = $request->address;
            $customer->note = $request->note;

            if($request->hasFile("image")) {
                $image_url = imageUploader($request->file('image'), 'customer', $customer->image);
                $customer->image = $image_url;
            }

            $customer->save();

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
