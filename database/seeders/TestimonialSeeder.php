<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            DB::beginTransaction();
            $this->testimonialCreate();
            DB::commit();
            $this->command->info('Testimonial Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function testimonialCreate()
    {

        for ($i = 1; $i < 15; $i++) {
            Testimonial::insert([
                'name' => 'Testimonial ' . $i,
                'designation' => 'Software Developer',
                'review' => 'Lorem ipsum dolor sit',
                'status' => 'Active',
                'rating' => rand(1, 5),
                'create_by' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
