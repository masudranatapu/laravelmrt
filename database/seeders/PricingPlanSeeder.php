<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->pricingPlanCreate();
            DB::commit();
            $this->command->info('Pricing Plan Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function pricingPlanCreate()
    {
        $months = $this->month();

        foreach ($months as $key => $month) {

            $discountType = $key % 2 == 0 ? 'Percentage' : 'Amount';

            PricingPlan::insert([
                'month' => $key,
                'discount_type' => $discountType,
                'discount_value' => $discountType == 'Percentage' ? rand(1, 20) : rand(399, 1299),
                'admin_id' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }


    public function month()
    {
        $month = [
            '1' => '1 Month',
            '2' => '2 Month',
            '3' => '3 Month',
            '4' => '4 Month',
            '5' => '5 Month',
            '6' => '6 Month',
            '7' => '7 Month',
            '8' => '8 Month',
            '9' => '9 Month',
            '10' => '10 Months',
            '11' => '11 Months',
            '12' => '12 Months',
            '24' => '24 Months',
            '36' => '36 Months',
            '60' => '60 Months',
        ];
        return $month;
    }
}
