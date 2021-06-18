<?php

use App\Http\Controllers\AuthenticationController;
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

Route::group(['middleware' => ['guest']], function () {

    Route::group(['as' => 'form.'], function () {

        Route::get('/login', [AuthenticationController::class, 'showLoginForm'])
            ->name('login');

        Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])
            ->name('register');

    });

    Route::post('/login', [AuthenticationController::class, 'login'])
        ->name('login');

    Route::post('/register', [AuthenticationController::class, 'register'])
        ->name('register');

});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

});
