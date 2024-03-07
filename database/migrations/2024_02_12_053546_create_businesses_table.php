<?php

use App\Models\Admin;
use App\Models\Business;
use App\Models\BusinessType;
use App\Models\Package;
use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Admin::class)->nullable();
            $table->foreignIdFor(Business::class)->nullable();
            $table->foreignIdFor(Package::class)->nullable();
            $table->foreignIdFor(PricingPlan::class)->nullable();
            $table->foreignIdFor(BusinessType::class)->nullable();
            $table->enum('type', ['Owner', 'Branch'])->default('Owner');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('currency')->nullable();
            $table->date('start_date')->nullable();
            $table->date('validity_start')->nullable();
            $table->date('validity')->nullable();
            $table->double('fees', 14, 4)->default(0);
            $table->double('service_charge', 14, 4)->default(0);
            $table->integer('branch_limit')->default(1);
            $table->integer('user_limit')->default(1);
            $table->integer('product_limit')->default(1);
            $table->double('inside_delivery_charge', 14, 4)->default(0);
            $table->double('outside_delivery_charge', 14, 4)->default(0);
            $table->double('free_delivery_charges_limit', 14, 4)->default(0);
            $table->double('ccustomer_commission_limit', 14, 4)->default(0);
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Blocked'])->default('Active');
            $table->json('business_access')->nullable();
            $table->boolean('enable_copyright')->default(0);
            $table->boolean('enable_send_mail')->default(0);
            $table->boolean('enable_sku_unique')->default(0);
            $table->boolean('enable_product_name_unique')->default(0);
            $table->boolean('enable_expire_date')->default(0);
            $table->boolean('enable_supplier_wise_products')->default(0);
            $table->boolean('enable_online_order')->default(0);
            $table->boolean('enable_user_commission')->default(0);
            $table->boolean('enable_customer_commission')->default(0);
            $table->boolean('enable_auto_print')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
