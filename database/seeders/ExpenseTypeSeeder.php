<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->expenseTypeCreate();
            DB::commit();
            $this->command->info('Expense Type Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function expenseTypeCreate()
    {

        for ($i = 1; $i < 8; $i++) {
            ExpenseType::insert([
                'business_id' => 1,
                'expense_type_name' => 'Expense Type Name ' . $i,
                'status' => 'Active',
                'sorting_number' => $i,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
