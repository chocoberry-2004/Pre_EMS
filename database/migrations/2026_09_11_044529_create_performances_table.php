<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employee')
                ->cascadeOnDelete();

            $table->foreignId('reviewer_id')
                ->constrained('employee')
                ->restrictOnDelete();

            $table->enum('performance_rating', [
                'needs_improvement',
                'normal',
                'good',
                'excellent',
            ])->default('normal');

            $table->text('comment')->nullable();

            $table->date('review_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};