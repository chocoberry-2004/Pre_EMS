<?php

namespace App\Http\Controllers;

use App\Models\Leave_request;
use App\Http\Requests\StoreLeave_requestRequest;
use App\Http\Requests\UpdateLeave_requestRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $employee = $this->employee();
        $leaveRequests = $employee->leave_requests()->latest()->paginate(10);

        return response()->json($leaveRequests);
    }

    public function manage(): JsonResponse
    {
        $leaveRequests = Leave_request::with(['employee.user', 'reviewer.user'])
            ->latest()
            ->paginate(15);

        return response()->json($leaveRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeave_requestRequest $request): JsonResponse
    {
        $leave = Leave_request::create([
            ...$request->validated(),
            'employee_id' => $this->employee()->id,
        ]);

        return response()->json($leave, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave_request $leave): JsonResponse
    {
        $this->ensureOwnerOrManager($leave);

        return response()->json($leave->load(['employee.user', 'reviewer.user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeave_requestRequest $request, Leave_request $leave): JsonResponse
    {
        $this->ensurePendingOwner($leave);
        $leave->update($request->validated());

        return response()->json($leave->fresh());
    }

    public function approve(Leave_request $leave): JsonResponse
    {
        return $this->review($leave, 'approved');
    }

    public function reject(Leave_request $leave): JsonResponse
    {
        return $this->review($leave, 'rejected');
    }

    private function review(Leave_request $leave, string $status): JsonResponse
    {
        abort_unless($leave->status === 'pending', 422, 'This leave request has already been reviewed.');

        $leave->update([
            'status' => $status,
            'approved_by' => $this->employee()->id,
            'approved_at' => now(),
        ]);

        return response()->json($leave->fresh());
    }

    private function employee()
    {
        $employee = Auth::user()->employee;
        abort_unless($employee, 403, 'An employee profile is required to use leave requests.');

        return $employee;
    }

    private function ensureOwnerOrManager(Leave_request $leave): void
    {
        abort_unless(Auth::user()->isManager() || $leave->employee_id === $this->employee()->id, 403);
    }

    private function ensurePendingOwner(Leave_request $leave): void
    {
        abort_unless($leave->status === 'pending' && $leave->employee_id === $this->employee()->id, 403);
    }
}
