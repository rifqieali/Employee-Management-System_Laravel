<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::withCount('employees')->latest('id')->paginate(10);
        return view('department', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'dept_name' => $request->dept_name ?? $request->department,
        ]);

        $validated = $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        Department::create($validated);

        return redirect()->route('department.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load('employees');
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->merge([
            'dept_name' => $request->dept_name ?? $request->department,
        ]);

        $validated = $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        $department->update($validated);

        return redirect()->route('department.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department->employees()->exists()) {
            return redirect()->route('department.index')
                ->with('error', 'Cannot delete department because it still has associated employees.');
        }

        $department->delete();
        return redirect()->route('department.index')
            ->with('success', 'Department deleted successfully.');
    }
}
