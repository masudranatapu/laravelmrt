<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Business;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Account;
// use App\Models\Sale;
// use App\Models\Service;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Business::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(ExpenseType::class)->nullable();
            $table->foreignIdFor(Account::class)->nullable();
            // $table->foreignIdFor(Sale::class)->nullable();
            // $table->foreignIdFor(Account::class)->nullable();
            $table->string('pay_by')->nullable();
            $table->date('date');
            $table->float('amount', 14, 2)->default(0);
            $table->text('note')->nullable();
            $table->string('ck_number')->nullable();
            $table->date('ck_issue_date')->nullable();
            $table->date('ck_active_date')->nullable();
            $table->string('ck_issue_name')->nullable();
            $table->string('ck_bank_name')->nullable();
            $table->string('is_check_paid')->default(0)->commnet("0=Inactive; 1=Active;");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
