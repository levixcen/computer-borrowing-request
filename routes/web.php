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

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['verified']], function () {

        Route::get('/', HomeController::class)
            ->name('home');

        Route::resource('borrowing-requests', BorrowingRequestController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::resource('schedules', ScheduleController::class)
            ->only(['show']);

    });

});

Route::group(['middleware' => ['auth', 'signed']], function () {

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\AuthenticationController::class, 'verifyEmail'])
        ->name('verification.verify');

});

Route::get('/email/verify', [\App\Http\Controllers\AuthenticationController::class, 'showVerifyPrompt'])
    ->name('verification.notice');
