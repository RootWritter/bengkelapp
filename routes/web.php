<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('mechanic', [MasterController::class, 'mechanic']);
    });
});
Route::get('auth/login', [AuthController::class, 'login_page'])->name('login');
Route::post('auth/doLogin', [AuthController::class, 'login']);
