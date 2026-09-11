<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    /** @use HasFactory<\Database\Factories\QualificationFactory> */
    use HasFactory;

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
