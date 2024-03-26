<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\BusinessRequest;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Http\Resources\Admin\AdminBusinessResource;
use App\Models\BusinessType;
use App\Models\Customer;
use App\Models\Package;
use App\Models\PricingPlan;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminBusinessController extends Controller
{
    //
    public function index()
    {
        return view("admin.business.index");
    }

    public function businessList(Request $request)
    {
        try {
            $par_page = $request->per_page ?? 10;
            $business = Business::query()
                ->latest()
                ->get();
            return AdminBusinessResource::collection($business);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function create()
    {
        $packages = Package::query()
            ->select(['id', 'title',])
            ->get();

        $pricingPlans = PricingPlan::query()
            ->select(['id', 'month'])
            ->get();
        $businessType = BusinessType::query()
            ->select(['id', 'business_type_name'])
            ->get();
        return view("admin.business.create", compact("packages", "pricingPlans", "businessType"));
    }


    public function store(BusinessRequest $request)
    {
        try {
            DB::beginTransaction();
            // create business user
            $user = $this->createUser($request);

            $business = $this->createBusiness($request, $user);
            // create guest customer
            $this->guestCustomer($business);
            // create guest supplier
            $this->guestSupplier($business);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function createBusiness($request)
    {
        $business = new Business();
        $business->admin_id = adminUser()->id;
        $business->package_id = $request->package_id;
        $business->pricing_plan_id = $request->pricing_plan_id;
        $business->business_type_id = $request->business_type_id;
        $business->type = 'Owner';
        $business->name = $request->name;
        $business->email = $request->email;
        $business->logo = $request->logo;
        $business->favicon = $request->favicon;
        $business->address = $request->address;
        $business->zip_code = $request->zip_code;
        $business->area = $request->area;
        $business->city = $request->city;
        $business->country = $request->country;
        $business->phone = $request->phone;
        $business->website = $request->website;
        $business->start_date = date('Y-m-d', strtotime($request->start_date));
        $business->validity_start = date('Y-m-d', strtotime($request->validity_start));
        $business->fees = $request->fees;
        $business->service_charge = $request->service_charge;
        $business->branch_limit = $request->branch_limit;
        $business->user_limit = $request->user_limit;
        $business->product_limit = $request->product_limit;
        $business->status = $request->status;
        $business->business_access = $request->business_access ? json_encode($request->business_access) : [];
        $business->save();

        return $business;
    }

    public function createUser($request)
    {
        $user = new User();
        $user->status = 'Active';
        $user->save();
        return $user;
    }

    public function guestCustomer($business)
    {
        $customer = new Customer();
        $customer->business_id = $business->id;
        $customer->name = "Guest";
        $customer->email = "guest@guest.com";
        $customer->phone = "0123";
        $customer->gender = "Male";
        $customer->date_of_birth = Carbon::now();
        $customer->date = Carbon::now();
        $customer->status = 'Active';
        $customer->save();
        return $customer;
    }

    public function guestSupplier($business)
    {
        $supplier = new Supplier();
        $supplier->business_id = $business->id;
        $supplier->name = "Guest";
        $supplier->email = "guest@guest.com";
        $supplier->phone = "0123";
        $supplier->gender = "Male";
        $supplier->date_of_birth = Carbon::now();
        $supplier->date = Carbon::now();
        $supplier->status = 'Active';
        $supplier->save();
        return $supplier;
    }
}
