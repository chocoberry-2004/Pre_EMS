<?php

namespace App\Http\Controllers;

use App\Models\Leave_request;
use App\Http\Requests\StoreLeave_requestRequest;
use App\Http\Requests\UpdateLeave_requestRequest;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(!Auth::user()) {
            abort('403', 'unauthorized access');
        }
        $leave_request = Leave_request::all();
        return view("pages.leave.index", compact('leave_request'));
    }

    public function manage() {
        if(!Auth::user() && Auth::user()->role !== 'manager') {
            abort('403', 'unauthorized access');
        }

        $leave_request = Leave_request::all();
        return view("pages.leave.manage", compact('leave_request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if(!Auth::user()) {
            abort('403', 'unauthorized access');
        }

        return view('pages.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeave_requestRequest $request)
    {
        //
        if(!Auth::user()) {
            abort('403', 'unauthorized access');
        }

        $validated = $request->validated();

        Leave_request::create($validated);

        return view('pages.leave.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave_request $leave_request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave_request $leave_request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeave_requestRequest $request, Leave_request $leave_request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave_request $leave_request)
    {
        //
    }
}
