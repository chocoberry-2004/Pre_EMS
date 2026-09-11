<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee = Employee::all();
        return view("pages.employee.index", compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if(Auth::user() && Auth::user()->role === "manager") {
            abort("403", "Unauthorized access");
        }

        return view("pages.employee.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        if(Auth::user() && Auth::user()->role === "manager") {
            abort("403", "Unauthorized access");
        }

        $validated = $request->validated();

        Employee::created($validated);
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        if(Auth::user()) {
            abort("403", "Unauthorized access");
        }

        $employee = Employee::findOrFail($employee);
        return view('pages.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        if(Auth::user()) {
            abort("403", "Unauthorized access");
        }

        $employee = Employee::findOrFail($employee);
        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //

        if(Auth::user()) {
            abort("403", "Unauthorized access");
        }

        $validated = $request->validated();

        Employee::updated($validated);

        return redirect()->route('employee.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //

        if(Auth::user()) {
            abort("403", "Unauthorized access");
        }

        Employee::delete();

        return redirect()->route('employee.index');
    }
}
