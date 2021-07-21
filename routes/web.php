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

Route::middleware(\App\Http\Middleware\LangMiddleware::class)->group(function () {
    Auth::routes();

    Route::get('/lang/{lang}', [App\Http\Controllers\web\FrontendController::class, 'changeLang']);

    Route::get('/logout', [App\Http\Controllers\web\FrontendController::class, 'logout']);

});
