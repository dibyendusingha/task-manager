<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/login',[App\Http\Controllers\SystemController::class, 'login']);

/* Laravel Login end */

    /***
     * GUI route
     */
    Route::get('/'                  , [App\Http\Controllers\SystemController::class, 'login'])->name('dashboard');

    Route::get('/add-employee'      , [App\Http\Controllers\SystemController::class, 'login']);
    Route::get('/manage-employee'   , [App\Http\Controllers\SystemController::class, 'login']);
    Route::get('/add-task'          , [App\Http\Controllers\SystemController::class, 'login']);
    Route::get('/manage-task'       , [App\Http\Controllers\SystemController::class, 'login']);

    Route::get('/user-task'         , [App\Http\Controllers\SystemController::class, 'login']);
    Route::get('/add-user-task'     , [App\Http\Controllers\SystemController::class, 'login']);



    
