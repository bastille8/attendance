<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\TimestampsController;
use App\Http\Controllers\ReststampsController;
use App\Models\Stamp;
use App\Models\Rest;

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


Route::middleware('auth')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'index']);
});
Route::get('/attendance', [AuthenticatedSessionController::class, 'create']);

Route::post('/work_in', [TimestampsController::class, 'create']);
Route::post('/work_out', [TimestampsController::class, 'store']);

Route::post('/rest_in', [ReststampsController::class, 'create']);
Route::post('/rest_out', [ReststampsController::class, 'store']);

