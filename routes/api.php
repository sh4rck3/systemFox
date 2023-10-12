<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/users1', [UserController::class, 'index'])->name('users.index');
Route::group(['middleware' => ['auth:sanctum', 'throttle:10000,1']], function () {
    //usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

