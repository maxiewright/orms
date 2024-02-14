<?php

use Illuminate\Support\Facades\Route;
use Modules\ServiceFund\App\Http\Controllers\ServiceFundController;

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

Route::group([], function () {
    Route::resource('servicefund', ServiceFundController::class)->names('servicefund');
});
