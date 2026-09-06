<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')->latest('id')->paginate(10);
        return view('employee', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('dept_name')->get();

        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'emp_status' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Employee::create($validated);

        return redirect()->route('employee.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load('department');
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('dept_name')->get();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'emp_status' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee->update($validated);

        return redirect()->route('employee.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
