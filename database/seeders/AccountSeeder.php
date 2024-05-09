<?php

namespace Database\Seeders;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->createAccount();
            DB::commit();
            $this->command->info('Account Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function createAccount()
    {

        Account::create([
            'id' => 1,
            'type' => 'Cash',
            'status' => 'Active',
            'pm_charge' => 0,
            'created_at' => Carbon::now(),
        ]);

        Account::create([
            'id' => 2,
            'type' => 'Mobile Banking',
            'mobile_bank_name' => 'Nagad',
            'mobile_number' => '12826596548',
            'transfer_amount' => 0,
            'status' => 'Active',
            'pm_charge' => 1.8,
            'created_at' => Carbon::now(),
        ]);

        Account::create([
            'id' => 3,
            'type' => 'Mobile Banking',
            'mobile_bank_name' => 'Rocket',
            'mobile_number' => '1254952452',
            'status' => 'Active',
            'pm_charge' => 1.9,
            'created_at' => Carbon::now(),
        ]);
    }
}
