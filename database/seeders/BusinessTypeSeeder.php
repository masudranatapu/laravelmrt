<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->businessTypeCreate();
            DB::commit();
            $this->command->info('Business Type Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function businessTypeCreate()
    {
        for ($i = 1; $i < 8; $i++) {
            BusinessType::insert([
                'business_type_name' => 'Business Type ' . $i,
                'status' => 'Active',
                'admin_id' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
