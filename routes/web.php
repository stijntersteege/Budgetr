<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard')->with([
        'monthlyIncome' => Auth::user()->monthlyIncome(),
        'annualIncome' => Auth::user()->annualIncome(),
        'monthlyExpenses' => Auth::user()->monthlyExpenses(),
        'annualExpenses' => Auth::user()->annualExpenses(),
    ]);
})->name('dashboard');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('income', IncomeController::class)->names([
        'index' => 'income'
    ]);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('expenses', ExpenseController::class)->names([
        'index' => 'expenses'
    ]);
});
