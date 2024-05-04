<?php

namespace Database\Seeders;

use App\Models\CustomerGroup;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->customerGroupCreate();
            DB::commit();
            $this->command->info('Customer Group Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function customerGroupCreate()
    {
        for ($i = 1; $i < 16; $i++) {
            CustomerGroup::insert([
                'business_id' => 1,
                'name' => 'Group' . $i,
                'amount' => rand(100, 500),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
