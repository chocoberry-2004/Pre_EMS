<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('department')->onDelete('cascade');
            $table->string('profile_url')->nullable();
            $table->string('phone_no');
            $table->string('nrc_no');
            $table->string('address');
            $table->date("dob");
            $table->enum("gender", ['male', 'female', 'other']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->date('hire_date');
            $table->string('position');
            $table->decimal('salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
