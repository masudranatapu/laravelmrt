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
    public function index()
    {
        return view("admin.business.index");
    }

    public function dataList(Request $request)
    {
        try {
            $business = Business::query()
                ->latest()
                ->paginate($request->per_page ?? 10);
            return AdminBusinessResource::collection($business);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
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
            // create business
            $business = $this->createBusiness($request, $user);
            // update user with business id
            $user->business_id = $business->id;
            $user->save();
            // create guest customer
            $this->guestCustomer($business);
            // create guest supplier
            $this->guestSupplier($business);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Business Successfully Updated',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function createBusiness($request, $user)
    {
        $business = new Business();
        $business->user_id = $user->id;
        $business->admin_id = adminUser()->id;
        $business->business_id = $request->sub_business_id ? $request->sub_business_id : null;
        $business->package_id = $request->package_id;
        $business->pricing_plan_id = $request->pricing_plan_id;
        $business->business_type_id = $request->business_type_id;
        $business->type = 'Owner';
        $business->name = $request->name;
        $business->email = $request->email;

        if ($request->hasFile("logo")) {

            $image_url = imageUploader(
                $file = $request->file('logo'),
                $path = 'business',
                $width = 200,
                $height = 200,
                $old_image = $business->logo
            );

            $business->logo = $image_url;
        }


        if ($request->hasFile("favicon")) {

            $image_url = imageUploader(
                $file = $request->file('favicon'),
                $path = 'business',
                $width = 16,
                $height = 16,
                $old_image = $business->favicon
            );

            $business->favicon = $image_url;
        }

        $business->address = $request->address;
        $business->zip_code = $request->zip_code;
        $business->area = $request->area;
        $business->city = $request->city;
        $business->country = $request->country;
        $business->phone = $request->phone;
        $business->website = $request->website;
        $business->start_date = date('Y-m-d', strtotime($request->start_date));
        $business->validity_start = date('Y-m-d', strtotime($request->start_date));
        $business->validity = Carbon::parse($request->start_date)->addMonths($request->total_month)->format('Y-m-d');
        $business->fees = $request->fees;
        $business->service_charge = $request->service_charge;
        $business->branch_limit = $request->branch_limit;
        $business->user_limit = $request->user_limit;
        $business->product_limit = $request->product_limit;
        $business->status = 'Active';
        $business->business_access = $request->option_access ? json_encode($request->option_access) : [];

        foreach ($request->option_access as $row) {
            $business->$row = 1;
        }

        $business->save();

        return $business;
    }

    public function createUser($request)
    {
        $user = new User();
        $user->admin_id = adminUser()->id;
        $user->package_id = $request->package_id;
        $user->name = $request->user_name;
        $user->username = strtolower(str_replace(' ', '', $request->user_name . rand(1, 9999)));
        $user->email = $request->user_email;
        $user->status = 'Active';
        $user->password = Hash::make($request->password);
        $user->date = date('Y-d-m');
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
    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $request = request();
            $business = Business::query()
                ->findOrFail($id);
            $business->status = $request->status;
            $business->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Business $business->status Successfully Done",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $packages = Package::query()
                ->select(['id', 'title',])
                ->get();

            $pricingPlans = PricingPlan::query()
                ->select(['id', 'month'])
                ->get();
            $businessType = BusinessType::query()
                ->select(['id', 'business_type_name'])
                ->get();
            $business = Business::query()
                ->findOrFail($id);
            return view("admin.business.edit", compact("packages", "pricingPlans", "businessType", 'business'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
