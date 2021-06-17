<?php

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

Route::get('/', HomeController::class)
    ->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('borrowing-requests', BorrowingRequestController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::resource('schedules', ScheduleController::class)
        ->only(['index', 'show']);

});



