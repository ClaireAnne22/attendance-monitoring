<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSubjects = Subject::count();
        $totalStudents = Student::count();
        $studentsPerSubject = Subject::withCount('students')->get();

        return view('dashboard', compact('totalSubjects', 'totalStudents', 'studentsPerSubject'));
    }
} 