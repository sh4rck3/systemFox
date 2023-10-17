<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\UserwebController;

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

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/information', [PageController::class, 'information'])->name('information');
Route::get('/extension', [PageController::class, 'extension'])->name('extension');
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    //access route to the dashboard
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    //access route to the user list
    Route::get('/user', [UserwebController::class, 'index'])->name('user');
    //acess router user local
    Route::get('/userlocal', [UserwebController::class, 'userlocal'])->name('userlocal');
});