<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->userCreate();
            DB::commit();
            $this->command->info('User Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function userCreate()
    {
        User::insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
        ]);
    }
}
