<?php

namespace Database\Seeders;

use App\Models\StudentTaskPerformanceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTaskPerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    StudentTaskPerformanceCategory::query()->delete();
	    StudentTaskPerformanceCategory::factory()->count(3)->create();
    }
}
