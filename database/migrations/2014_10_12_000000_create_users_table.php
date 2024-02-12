<?php

use App\Models\Admin;
use App\Models\Business;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Business::class)->nullable();
            $table->foreignIdFor(Admin::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->integer('package_id')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Blocked', 'Pending'])->default('Active');
            $table->date('date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
