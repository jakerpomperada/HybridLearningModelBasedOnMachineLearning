<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    Teacher::query()->delete();
	    $user = User::where([
		    'type' => 'teacher'
	    ])->first();
	    
	    Teacher::factory()->create([
		    'user_id' => $user->id
	    ]);
    }
}
