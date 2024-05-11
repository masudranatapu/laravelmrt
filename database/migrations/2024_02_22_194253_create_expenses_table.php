<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Business;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Account;
// use App\Models\Sale;

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
            $table->foreignIdFor(ExpenseType::class)->nullable();
            $table->foreignIdFor(Account::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            // $table->foreignIdFor(Sale::class)->nullable();
            $table->string('pay_by')->nullable();
            $table->date('date');
            $table->double('amount', 14, 2)->default(0);
            $table->string('ck_number')->nullable();
            $table->date('ck_issue_date')->nullable();
            $table->date('ck_active_date')->nullable();
            $table->string('ck_issue_name')->nullable();
            $table->string('ck_bank_name')->nullable();
            $table->enum('is_check_paid', ['Yes', 'No'])->default('No');
            $table->text('note')->nullable();
            $table->integer('sorting_number')->default(0);
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
