<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Business;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Business::class)->nullable();
            $table->string('account_type')->nullable();
            $table->string('mobile_bank_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->integer('bank_list_id')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_branch')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('valid_thru_month')->nullable();
            $table->string('valid_thru_year')->nullable();
            $table->string('cvv_code')->nullable();
            $table->float('amount', 14, 2)->default(0)->nullable();
            $table->float('transfer_amount', 14, 2)->default(0)->nullable();
            $table->integer('status')->default(1)->comment('0=Inactive; 1=Active;');
            $table->float('pm_charge', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
