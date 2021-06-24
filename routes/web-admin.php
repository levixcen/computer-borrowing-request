<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application with role
| of Administrator. These routes are loaded by the RouteServiceProvider
| within a group which contains the "web" middleware group.
| Now create something great!
|
*/

Route::get('/', HomeController::class)
    ->name('home');

Route::resource('rooms', RoomController::class)
    ->except(['show']);

Route::resource('computers', ComputerController::class)
    ->except(['index', 'show']);

Route::resource('borrowing-requests', BorrowingRequestController::class)
    ->only(['index', 'show', 'update']);

Route::resource('schedules', ScheduleController::class)
    ->only(['index', 'show', 'destroy']);

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {

    Route::get('/computers', [\App\Http\Controllers\Admin\ComputerController::class, 'ajaxIndex'])
        ->name('computers.index');

});
