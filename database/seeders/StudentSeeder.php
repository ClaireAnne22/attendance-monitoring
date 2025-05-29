<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create(['name' => 'John Doe', 'email' => 'john@example.com', 'subject_id' => 1]);
        Student::create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'subject_id' => 2]);
        Student::create(['name' => 'Bob Johnson', 'email' => 'bob@example.com', 'subject_id' => 3]);
    }
} 