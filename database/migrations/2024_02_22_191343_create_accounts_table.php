<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Business;
use App\Models\Bank;

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
            $table->foreignIdFor(Bank::class)->nullable();
            $table->enum('account_type', ['Cash', 'Mobile Banking', 'Card', 'Bank Account', 'Other'])->nullable();
            $table->string('mobile_bank_name')->nullable();
            $table->string('mobile_number')->nullable();
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
            $table->double('amount', 14, 2)->default(0);
            $table->double('transfer_amount', 14, 2)->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->double('pm_charge', 14, 2)->default(0);
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
