<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create(['name' => 'Mathematics']);
        Subject::create(['name' => 'Science']);
        Subject::create(['name' => 'History']);
    }
} 