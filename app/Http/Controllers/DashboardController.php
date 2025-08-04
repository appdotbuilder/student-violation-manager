<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Violation;
use App\Models\ViolationCategory;
use App\Models\ViolationType;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Base statistics
        $stats = [
            'total_students' => Student::active()->count(),
            'total_violations' => $user->isTeacher() 
                ? Violation::where('recorded_by', $user->id)->count()
                : Violation::count(),
            'total_categories' => ViolationCategory::active()->count(),
            'total_types' => ViolationType::active()->count(),
        ];

        if ($user->isAdministrator()) {
            $stats['total_users'] = User::count();
        }

        // Recent violations
        $recentViolationsQuery = Violation::with([
            'student',
            'violationCategory',
            'violationType',
            'recordedBy'
        ]);

        if ($user->isTeacher()) {
            $recentViolationsQuery->where('recorded_by', $user->id);
        }

        $recentViolations = $recentViolationsQuery
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Top violations by category (current month)
        $topCategoriesQuery = ViolationCategory::withCount([
            'violations' => function ($query) {
                $query->whereMonth('violation_date', now()->month)
                      ->whereYear('violation_date', now()->year);
            }
        ]);

        $topCategories = $topCategoriesQuery
            ->orderByDesc('violations_count')
            ->limit(5)
            ->get();

        // Students with most violations (current month)
        $topStudentsQuery = Student::withCount([
            'violations' => function ($query) {
                $query->whereMonth('violation_date', now()->month)
                      ->whereYear('violation_date', now()->year);
            }
        ])->with(['violations' => function ($query) {
            $query->whereMonth('violation_date', now()->month)
                  ->whereYear('violation_date', now()->year);
        }]);

        $topStudents = $topStudentsQuery
            ->orderByDesc('violations_count')
            ->limit(10)
            ->get();

        // Monthly violations chart data
        $monthlyViolations = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Violation::whereMonth('violation_date', $date->month)
                            ->whereYear('violation_date', $date->year);
            
            if ($user->isTeacher()) {
                $count->where('recorded_by', $user->id);
            }
            
            $monthlyViolations[] = [
                'month' => $date->format('M Y'),
                'count' => $count->count()
            ];
        }

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentViolations' => $recentViolations,
            'topCategories' => $topCategories,
            'topStudents' => $topStudents,
            'monthlyViolations' => $monthlyViolations,
        ]);
    }
}