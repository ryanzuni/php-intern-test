<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/employee-form', function () {
    return view('employee-form');
});

Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store'])
    ->name('employees.store');
