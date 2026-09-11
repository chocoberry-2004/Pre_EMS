<?php

namespace App\Http\Controllers;

use App\Models\Leave_request;
use App\Http\Requests\StoreLeave_requestRequest;
use App\Http\Requests\UpdateLeave_requestRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeave_requestRequest $request)
    {
        //
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
