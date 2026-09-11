<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function leave_requests() {
        return $this->hasMany(Leave_request::class);
    }

    public function attenances() {
        return $this->hasMany(Attendance::class);
    }

    public function performances() {
        return $this->hasMany(Performance::class);
    }


    public function qualifications() {
        return $this->hasMany(Qualification::class);
    }


}
