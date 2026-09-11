<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});



// public routes

Route::get('/', function() {
    return view("pages.index");
});



Route::middleware(['auth', 'manager'])->prefix('employee')->name('employee.')->group(function() {
    Route::get("/", [EmployeeController::class, 'index'])->name('index');
    Route::get("/create", [EmployeeController::class, 'create'])->name('create');
    Route::post("/", [EmployeeController::class, 'store'])->name('store');
    Route::get("/show/{employee}", [EmployeeController::class, 'show'])->name('show');
    Route::get("/edit/{employee}", [EmployeeController::class, 'edit'])->name('edit');
    Route::put("/{employee}", [EmployeeController::class, 'update'])->name('update');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
