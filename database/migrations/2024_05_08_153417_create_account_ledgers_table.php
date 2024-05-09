<?php

use App\Models\Account;
use App\Models\Business;
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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Business::class)->nullable();
            $table->foreignIdFor(Account::class)->nullable();
            $table->date('date')->nullable();
            $table->double('debit_amount', 12, 2)->default(0);
            $table->double('credit_amount', 12, 2)->default(0);
            $table->string('source_type', 191);
            $table->unsignedBigInteger('source_id');
            $table->string('payer_type', 191);
            $table->unsignedBigInteger('payer_id');
            $table->string('type', 191)->nullable();
            $table->text('note')->nullable();
            $table->longText('data')->nullable();
            $table->index(['source_type', 'source_id']);
            $table->index(['payer_type', 'payer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_ledgers');
    }
};
