<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->adminCreate();
            DB::commit();
            $this->command->info('Admin Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function adminCreate()
    {
        Admin::insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
        ]);
    }
}
