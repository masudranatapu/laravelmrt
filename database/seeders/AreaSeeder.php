<?php

namespace Database\Seeders;

use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->areaCreate();
            DB::commit();
            $this->command->info('Area Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function areaCreate()
    {
        for ($i = 1; $i < 16; $i++) {
            Area::insert([
                'business_id' => 1,
                'name' => 'Area' . $i,
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
