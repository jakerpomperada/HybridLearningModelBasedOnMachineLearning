<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\TeachingLoad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachingLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    TeachingLoad::query()->delete();
		
        TeachingLoad::factory()->count(5)->create();
    }
}
