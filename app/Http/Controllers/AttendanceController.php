<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'subject'])
            ->latest()
            ->paginate(10);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('attendance.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string',
        ]);

        try {
            Attendance::create($validated);
            return redirect()->route('attendance.index')
                ->with('success', 'Attendance recorded successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062) {
                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Attendance for this student and subject on the selected date already exists.']);
            }
            
            // For other database errors, rethrow the exception
            throw $e;
        }
    }

    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('attendance.edit', compact('attendance', 'students', 'subjects'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }
} 