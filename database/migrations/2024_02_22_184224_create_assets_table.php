<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Business;
use App\Models\AssetCategory;
use App\Models\Account;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Business::class)->nullable();
            $table->foreignIdFor(AssetCategory::class)->nullable();
            $table->foreignIdFor(Account::class)->nullable();
            $table->string('pay_by')->nullable();
            $table->date('date');
            $table->double('amount', 14, 4)->default(0);
            $table->text('note')->nullable();
            $table->integer('create_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
