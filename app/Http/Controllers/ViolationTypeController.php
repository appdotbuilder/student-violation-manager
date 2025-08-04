<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViolationTypeRequest;
use App\Http\Requests\UpdateViolationTypeRequest;
use App\Models\ViolationType;
use App\Models\ViolationCategory;
use Inertia\Inertia;

class ViolationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = ViolationType::with('violationCategory')
            ->withCount('violations')
            ->orderBy('points')
            ->orderBy('name')
            ->paginate(15);

        return Inertia::render('violation-types/index', [
            'types' => $types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ViolationCategory::active()->orderBy('name')->get();

        return Inertia::render('violation-types/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViolationTypeRequest $request)
    {
        $type = ViolationType::create($request->validated());

        return redirect()->route('violation-types.show', $type)
            ->with('success', 'Violation type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ViolationType $violationType)
    {
        $violationType->load('violationCategory');

        return Inertia::render('violation-types/show', [
            'type' => $violationType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ViolationType $violationType)
    {
        $categories = ViolationCategory::active()->orderBy('name')->get();
        $violationType->load('violationCategory');

        return Inertia::render('violation-types/edit', [
            'type' => $violationType,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViolationTypeRequest $request, ViolationType $violationType)
    {
        $violationType->update($request->validated());

        return redirect()->route('violation-types.show', $violationType)
            ->with('success', 'Violation type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationType $violationType)
    {
        $violationType->delete();

        return redirect()->route('violation-types.index')
            ->with('success', 'Violation type deleted successfully.');
    }
}