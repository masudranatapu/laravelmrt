<?php

namespace Database\Seeders;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->packageCreate();
            DB::commit();
            $this->command->info('Package Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function packageCreate()
    {

        for ($i = 1; $i < 8; $i++) {
            Package::insert([
                'title' => 'Package ' . $i,
                'monthly_service_charge' => rand(1000, 1200),
                'installment_fee' => rand(15000, 20000),
                'customer_limit' => rand(390, 5000),
                'supplier_limit' => rand(390, 5000),
                'user_limit' => rand(5, 20),
                'product_limit' => rand(1000, 2000),
                'branch_limit' => rand(1, 10),
                'description' => 'Lorem ipsum dolors',
                'admin_id' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
