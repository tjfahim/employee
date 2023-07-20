<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin.dashboard');



    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::post('/update_employees', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('/employees_delete', [EmployeeController::class, 'destroy'])->name('employees.destroy');


    Route::get('/post', [PostController::class, 'index'])->name('post.all');
    Route::post('/add-post', [PostController::class, 'store'])->name('post.store');
    Route::post('/update-post', [PostController::class, 'update'])->name('post.update');
    Route::post('/delete-post', [PostController::class, 'destroy'])->name('post.destroy');


});
require __DIR__.'/auth.php';


