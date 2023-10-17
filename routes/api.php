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
Route::get('/users1', [UserController::class, 'indexold'])->name('users.indexold');
//users from list employees
Route::get('/usershome', [UserController::class, 'indexhome'])->name('users.indexhome');

Route::group(['middleware' => ['auth:sanctum', 'throttle:10000,1']], function () {
    //users from list employees GLPI
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //users from list system users
    Route::get('/userssystem', [UserController::class, 'userssystem'])->name('users.userssystem');
    //atualization of users from api
    Route::get('/usersupdate', [UserController::class, 'usersupdate'])->name('users.usersupdate');
     //users from list employees local
     Route::get('/userslocal', [UserController::class, 'userslocal'])->name('users.userslocal');
});

