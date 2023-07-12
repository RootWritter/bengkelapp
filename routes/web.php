<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('cashier', [DashboardController::class, 'cashier']);
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('mechanic', [MasterController::class, 'mechanic']);
        Route::get('sparepart', [MasterController::class, 'sparepart']);
    });
    Route::group(['prefix' => 'data', 'as' => 'data.'], function () {
        Route::get('mechanic', [DataController::class, 'mechanic']);
        Route::post('mechanic', [DataController::class, 'getMechanic']);
        Route::get('sparepart', [DataController::class, 'sparepart']);
        Route::post('sparepart', [DataController::class, 'getSparepart']);
        Route::post('fetch-sparepart', [DataController::class, 'fetchParts']);
    });
    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
        Route::post('mechanic', [AjaxController::class, 'mechanic']);
        Route::post('sparepart', [AjaxController::class, 'sparepart']);
    });
});
Route::get('auth/login', [AuthController::class, 'login_page'])->name('login');
Route::post('auth/doLogin', [AuthController::class, 'login']);
