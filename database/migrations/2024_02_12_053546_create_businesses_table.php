<?php

use App\Models\Admin;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Blocked'])->default('Active');
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
