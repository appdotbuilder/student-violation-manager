<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViolationCategoryRequest;
use App\Http\Requests\UpdateViolationCategoryRequest;
use App\Models\ViolationCategory;
use Inertia\Inertia;

class ViolationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ViolationCategory::withCount('violationTypes')
            ->withCount('violations')
            ->orderBy('name')
            ->paginate(15);

        return Inertia::render('violation-categories/index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('violation-categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViolationCategoryRequest $request)
    {
        $category = ViolationCategory::create($request->validated());

        return redirect()->route('violation-categories.show', $category)
            ->with('success', 'Violation category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ViolationCategory $violationCategory)
    {
        $violationCategory->load([
            'violationTypes' => function ($query) {
                $query->orderBy('points')->orderBy('name');
            }
        ]);

        return Inertia::render('violation-categories/show', [
            'category' => $violationCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ViolationCategory $violationCategory)
    {
        return Inertia::render('violation-categories/edit', [
            'category' => $violationCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViolationCategoryRequest $request, ViolationCategory $violationCategory)
    {
        $violationCategory->update($request->validated());

        return redirect()->route('violation-categories.show', $violationCategory)
            ->with('success', 'Violation category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationCategory $violationCategory)
    {
        $violationCategory->delete();

        return redirect()->route('violation-categories.index')
            ->with('success', 'Violation category deleted successfully.');
    }
}