<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViolationRequest;
use App\Models\Violation;
use App\Models\Student;
use App\Models\ViolationCategory;
use App\Models\ViolationType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Violation::with([
            'student',
            'violationCategory',
            'violationType',
            'recordedBy'
        ]);

        // Role-based filtering
        if (auth()->user()->isTeacher()) {
            $query->where('recorded_by', auth()->id());
        }

        // Date range filter
        if ($request->has('date_from') && $request->date_from) {
            $query->where('violation_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('violation_date', '<=', $request->date_to);
        }

        // Student filter
        if ($request->has('student_id') && $request->student_id) {
            $query->where('student_id', $request->student_id);
        }

        // Category filter
        if ($request->has('category_id') && $request->category_id) {
            $query->where('violation_category_id', $request->category_id);
        }

        // Class filter
        if ($request->has('class') && $request->class) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('class', $request->class);
            });
        }

        $violations = $query->orderByDesc('violation_date')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends($request->query());

        // Get filter options
        $students = Student::active()->orderBy('name')->get(['id', 'name', 'class']);
        $categories = ViolationCategory::active()->orderBy('name')->get(['id', 'name']);
        $classes = Student::distinct()->pluck('class')->sort()->values();

        return Inertia::render('violations/index', [
            'violations' => $violations,
            'students' => $students,
            'categories' => $categories,
            'classes' => $classes,
            'filters' => $request->only(['date_from', 'date_to', 'student_id', 'category_id', 'class']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::active()->orderBy('name')->get(['id', 'name', 'class', 'student_id']);
        $categories = ViolationCategory::active()->with('violationTypes')->orderBy('name')->get();

        return Inertia::render('violations/create', [
            'students' => $students,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViolationRequest $request)
    {
        // Get the violation type to get points
        $violationType = ViolationType::findOrFail($request->violation_type_id);
        
        // Create the violation
        $violation = Violation::create([
            ...$request->validated(),
            'points' => $violationType->points,
            'recorded_by' => auth()->id(),
        ]);

        // Update student's total points
        $violation->student->updateTotalPoints();

        return redirect()->route('violations.show', $violation)
            ->with('success', 'Violation recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Violation $violation)
    {
        $violation->load([
            'student',
            'violationCategory',
            'violationType',
            'recordedBy'
        ]);

        return Inertia::render('violations/show', [
            'violation' => $violation,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        // Only allow deletion by administrators or the teacher who recorded it
        if (!auth()->user()->isAdministrator() && $violation->recorded_by !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $student = $violation->student;
        $violation->delete();
        
        // Update student's total points
        $student->updateTotalPoints();

        return redirect()->route('violations.index')
            ->with('success', 'Violation deleted successfully.');
    }
}