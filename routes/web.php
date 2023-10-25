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

Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


//Companies

Route::resource('companies',\App\Http\Controllers\Admin\CompanyController::class)->except(['show']);



//Employees

Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class)->except(['show']);
