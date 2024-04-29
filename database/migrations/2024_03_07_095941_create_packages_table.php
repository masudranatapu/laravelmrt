<?php

use App\Models\Admin;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Admin::class)->nullable();
            $table->string('title')->nullable();
            $table->double('monthly_service_charge', 14, 4)->default(0);
            $table->double('installment_fee', 14, 4)->default(0);
            $table->integer('customer_limit')->default(10);
            $table->integer('supplier_limit')->default(10);
            $table->integer('user_limit')->default(4);
            $table->integer('product_limit')->default(250);
            $table->integer('branch_limit')->default(1);
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
